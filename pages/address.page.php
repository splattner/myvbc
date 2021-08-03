<?php

namespace splattner\myvbc\pages;

use splattner\myvbc\models\MPerson;
use splattner\myvbc\plugins\PHistory;
use splattner\myvbc\plugins\PPersondata;

use \Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use \Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class PageAddress extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "address";
        $this->template = "address/address.tpl";

        //$this->noACL["import"] = true;

        $this->acl->allow("vorstand", ["main","edit","new","delete","setState","setSignature","import","export","requestForm"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);
    }


    public function mainAction()
    {
        $this->smarty->assign("subContent1", "address/addressTable.tpl");
    }

    public function editAction()
    {
        $this->smarty->assign("subContent1", "address/edit.tpl");

        $data["personID"] = $_GET["personID"];
        $this->smarty->assign("personID", $data["personID"]);

        $plugin_personData = new PPersondata("persondata");
        $plugin_personData->setData($data);
        $plugin_personData->setFormURL("index.php?page={\$currentPage}&action=edit&personID={\$personID}");

        // History Plugin
        $plugin_history = new PHistory("history");
        $plugin_history->setData($data);
        $plugin_history->run(null);


        return $plugin_personData->run("editEntry");
    }

    public function newAction()
    {
        $this->smarty->assign("subContent1", "address/new.tpl");

        $plugin_personData = new PPersondata("persondata");
        $plugin_personData->setFormURL("index.php?page={\$currentPage}&action=new");

        return $plugin_personData->run("newEntry");
    }

    public function deleteAction()
    {
        $personID = $_GET["personID"];

        $person = new MPerson();
        $person->delete(array($person->pk => $personID));

        $this->smarty->assign("messages", "Person wurde aus Datenbank gel&ouml;scht!");

        return "main";
    }


    public function setStateAction()
    {
        $personID = $_GET["personID"];
        $state = $_GET["state"];

        $person = new MPerson();
        $person->setState($personID, $state);

        if ($state == "0") {
            $person->setSignature($personID, $state);
        }

        return "main";
    }

    public function setSignatureAction()
    {
        $personID = $_GET["personID"];
        $state = $_GET["state"];

        $person = new MPerson();
        $person->setSignature($personID, $state);

        return "main";
    }

    public function exportAction()
    {

        $this->enableRender = false; // Only CSV Output

        $writer = WriterEntityFactory::createCSVWriter();
        $writer->openToBrowser("export_clubdesk.csv");
        $writer->setShouldAddBOM(false);

        $header = [
            "Nachname",
            "Vorname",
            "Adresse",
            "PLZ",
            "Ort",
            "Telefon Privat",
            "Telefon Mobil",
            "E-Mail",
            "E-Mail Alternativ",
            "Geschlecht",
            "Geburtsdatum",
            "AHV Nr.",
            "Lizenz Spieler(in)",
            "Schreiber"
        ];

        $rowFromValues = WriterEntityFactory::createRowFromArray($header);
        $writer->addRow($rowFromValues);

        $person = new MPerson();
        $allpersons = $person->getRS(array("active =" => 1), array("name" => "ASC", "prename" => "ASC"))->fetchAll();

        foreach($allpersons as $person) {

            $row = array();
            $row[] = $person["name"];
            $row[] = $person["prename"];
            $row[] = $person["address"];
            $row[] = $person["plz"];
            $row[] = $person["ort"];
            $row[] = $person["phone"];
            $row[] = $person["mobile"];
            $row[] = trim($person["email"]);
            $row[] = trim($person["email_parent"]);
            switch ($person["gender"]) {
                case "m":
                    $row[] = "männlich";
                    break;
                case "w":
                    $row[] = "weiblich";
                    break;
            }
            $datepart = explode("-", $person["birthday"]);
            $birthday = $datepart[1] . "." . $datepart[2] . "." . $datepart[0];
            $row[] = $birthday;
            $row[] = $person["ahv"];
            // TODO: Lizenz
            $row[] = "";
            switch ($person["schreiber"]) {
                case 1:
                    $row[] = "Ja";
                    break;
                case 0:
                    $row[] = "Nein";
                    break;
            }

        

            $rowFromValues = WriterEntityFactory::createRowFromArray($row);
            $writer->addRow($rowFromValues);


        }



        $writer->close();
 
    }

    public function importAction()
    {

        $fieldMapping = array(
            "name" => "Nachname",
            "prename" => "Vorname",
            "plz" => "PLZ",
            "ort" => "Ort",
            "address" => "Adresse",
            "phone" => "Telefon Privat",
            "mobile" => "Telefon Mobil",
            "email" => "E-Mail",
            "email_parent" => "E-Mail Alternativ",
            "ahv" => "AHV Nr.",
            "externalid" => "[Id]",
            "genger" => "Geschlecht",
            "schreiber" => "Schreiber",
            "birthday" => "Geburtsdatum"
        );

        $this->smarty->assign("subContent1", "address/import.tpl");
        $this->smarty->assign("importStage", "new");

        $importData = array();

        if (isset($_POST["doImport"])) {

            $reader = ReaderEntityFactory::createCSVReader();
            $reader->open($_FILES['csv']['tmp_name']);

            $importData = array(); // Reset for new import
            
            $header = array();
            $readHeaderDone = false;

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();

                    if(!$readHeaderDone) {
                        // First line are the headers!
                        foreach ($cells as $cell) {
                            $header[] = $cell->getValue();
                        }
                        $readHeaderDone = true;
                    } else {
                        $entry = array();
                        $i = 0;
                        foreach ($cells as $cell) {
                            $entry[$header[$i]] = $cell->getValue();
                            $i++;
        
                        }

                        // Search if person is already in myvbc
                        // First with the externalid (if it was already imported once)
                        // Then with prename/name and birthday
                        // And final only prename/name

                        $datepart = explode(".", $entry[$fieldMapping["birthday"]]);
                        $birthday = $datepart[2] . "-" . $datepart[1] . "-" . $datepart[0];

                        $person = new MPerson();
                        $linkedperson = $person->getAddressEntry(array("persons.externalid =" => $entry["Id"]))->fetch();

                        if (!is_array($linkedperson)) {
                            if ($entry[$fieldMapping["birthday"]] != "") {
                                // More accurate with Birthday and Name
                                $linkedperson = $person->getAddressEntry(array("persons.name =" => $entry[$fieldMapping["name"]], "persons.prename =" => $entry[$fieldMapping["prename"]], "persons.birthday =" => $birthday))->fetch();
                            } else {
                                // Only Name
                                $linkedperson = $person->getAddressEntry(array("persons.name =" => $entry[$fieldMapping["name"]], "persons.prename =" => $entry[$fieldMapping["prename"]]))->fetch();
                            }
                        }

                        if (is_array($linkedperson)) {
                            $entry["linkedPerson"] = $linkedperson;
                            $entry["linkedPersonAvailable"] = true;
                        } else {
                            $entry["linkedPersonAvailable"] = false;
                        }

                        // Make some tests 
                        $entry["warnings"] = array();
                        $entry["warnings"]["birthdayNotSet"] = $entry["Geburtsdatum"] == "";
                        $entry["warnings"]["genderNotSet"] = $entry["Geschlecht"] == "";
                        $entry["warnings"]["emailNotSet"] = $entry["E-Mail"] == "";
                        $entry["warnings"]["mobileNotSet"] = $entry["Telefon Mobil"] == "";
                        $entry["warnings"]["addressNotSet"] = $entry["Adresse"] == "" || $entry["Ort"] == "" || $entry["PLZ"] == "";

                        $importData[] = $entry;
                    }

                }
            }

            $reader->close();

            $this->session->share["clubdeskimport"] = $importData;
            $this->smarty->assign("importStage", "preview");

            // For the dropdown
            $allpersons = new MPerson();
            $recordSet = $allpersons->getRS(array(), array("name" => "ASC", "prename" => "ASC"));
            $this->smarty->assign("allPersons", $recordSet->fetchAll());

        }

        if (isset($_POST["doImportFinal"])) {

            $importLog = "";

            // Load the data from preview stage
            if (count($this->session->share["clubdeskimport"]) > 0) {
                $importData = $this->session->share["clubdeskimport"];
            }

            $i=0;
            foreach ($importData as $personToImport) {

                $person = new MPerson();

                if ($_POST["linkedPerson"][$i] > 0) {
                    // Load existing person
                    $linkedperson = $person->getAddressEntry(array("persons.id =" => $_POST["linkedPerson"][$i]))->fetch();
                }
                
                $person->name = $personToImport["Nachname"];
                $person->prename = $personToImport["Vorname"];

                $person->externalid = $personToImport["[Id]"];

                // Do not overwrite data in myvbc if empty
                if ($personToImport[$fieldMapping["ort"]] != "" || $_POST["override"][$i] == "true") { $person->ort = $personToImport[$fieldMapping["ort"]];}
                if ($personToImport[$fieldMapping["plz"]] != "" || $_POST["override"][$i] == "true") { $person->plz = $personToImport[$fieldMapping["plz"]];}
                if ($personToImport[$fieldMapping["address"]] != "" || $_POST["override"][$i] == "true") { $person->address = $personToImport[$fieldMapping["address"]];}
                if ($personToImport[$fieldMapping["phone"]] != "" || $_POST["override"][$i] == "true") { $person->phone = $personToImport[$fieldMapping["phone"]];}
                if ($personToImport[$fieldMapping["mobile"]] != "" || $_POST["override"][$i] == "true") { $person->mobile = $personToImport[$fieldMapping["mobile"]];}
                if ($personToImport[$fieldMapping["email"]] != "" || $_POST["override"][$i] == "true") { $person->email = $personToImport[$fieldMapping["email"]];}
                if ($personToImport[$fieldMapping["email_parent"]] != "" || $_POST["override"][$i] == "true") { $person->email_parent = $personToImport[$fieldMapping["email_parent"]];}
                if ($personToImport[$fieldMapping["ahv"]] != "" || $_POST["override"][$i] == "true") { $person->ahv = $personToImport[$fieldMapping["ahv"]];}
                

                if ($personToImport[$fieldMapping["birthday"]] != "") { 
                    $datepart = explode(".", $personToImport[$fieldMapping["birthday"]]);
                    $birthday = $datepart[2] . "-" . $datepart[1] . "-" . $datepart[0];
                    $person->birthday = $birthday;
                }

                switch($personToImport[$fieldMapping["gender"]]) {
                    case "männlich":
                        $person->gender = "m";
                        break;
                    case "weiblich":
                        $person->gender = "w";
                        break;
                }

                switch($personToImport[$fieldMapping["schreiber"]]) {
                    case "Ja":
                        $person->schreiber = 1;
                        break;
                    case "Nein":
                        $person->schreiber = 0;
                        break;
                }

                if ($_POST["linkedPerson"][$i] == 0) {
                    // Create new Person
                    $person->password = "";
                    $person->role = "";
                    $person->sms = 1;
                    $person->signature = 1;


                    $person->insert();

                    $importLog = $importLog . $person->prename . " " . $person->name . " wurde neu hinzugefügt\n";

                }

                if ($_POST["linkedPerson"][$i] > 0) {
                    // Update the person
                    $person->update(array($person->pk => $_POST["linkedPerson"][$i]));

                    $importLog = $importLog .  $person->prename . " " . $person->name . " wurde aktualisiert\n";
                }

                $i++;
            }
            
            $this->smarty->assign("importStage", "imported");
            $this->smarty->assign("importLog", $importLog);
            $importData = array();
        }

        $this->smarty->assign("importData", $importData);

    }

    public function requestFormAction()
    {
        $this->smarty->assign("subContent1", "address/requestForm.tpl");


        $personID = $_GET["personID"];

        $user = new MPerson();
        $recordSet = $user->getRS(array($user->pk ." =" => $personID));
        $this->smarty->assign("person", $recordSet->fetch());
    }
}
