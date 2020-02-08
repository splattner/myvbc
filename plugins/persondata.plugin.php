<?php

namespace splattner\myvbc\plugins;

use splattner\framework\Plugin;
use splattner\framework\Model;
use splattner\myvbc\models\MPerson;
use splattner\myvbc\models\MLicence;

class PPersondata extends Plugin
{
    private $formURL;


    public function __toString()
    {
        $this->smarty->assign("formURL", $this->formURL);
        return Plugin::__toString();
    }

    public function run($action)
    {
        $return = "";

        switch ($action) {
            case "newEntry":
                $this->contentFile = "plugins/persondata/new.tpl";
                $return = $this->newEntry();
            break;
            case "editEntry":
                $this->contentFile = "plugins/persondata/edit.tpl";
                $return = $this->editEntry();

            break;
        }

        return $return;
    }


    public function setFormURL($formURL)
    {
        $this->formURL = $formURL;
    }

    private function newEntry()
    {
        if (isset($_POST["doNew"])) {


            $person = new MPerson();
            $person->name = $_POST["name"];
            $person->prename = $_POST["prename"];
            $person->ort = $_POST["ort"];
            $person->plz = $_POST["plz"];
            $person->address = $_POST["address"];
            $person->phone = $_POST["phone"];
            $person->mobile = $_POST["mobile"];
            $person->email = $_POST["email"];
            $person->email_parent = $_POST["email_parent"];
            $person->ahv = $_POST["ahv"];

            if ($_POST["birthday"] != "") {
              $datepart = explode(".", $_POST["birthday"]);
              $person->birthday = $datepart[2] . "-" . $datepart[1] . "-" . $datepart[0];
            } else {
              $person->birthday = date("Y-m-d");
            }

            $person->gender = $_POST["gender"];


            if (!isset($_POST["signature"])) {
                $person->signature = 0;
            } else {
                $person->signature = $_POST["signature"];
            }


            if (!isset($_POST["schreiber"])) {
                $person->schreiber = 0;
            } else {
                $person->schreiber = $_POST["schreiber"];
            }

            if (!isset($_POST["sms"])) {
                $person->sms = 0;
            } else {
                $person->sms = $_POST["sms"];
            }

            $person->licence = $_POST["licence"];
            $person->licence_comment = $_POST["licence_comment"];
            if ($_POST["refid"] != '') {
              $person->refid = $_POST["refid"];
            }

            $person->password = "";
            $person->role = "";

            $person->insert();

            $this->smarty->assign("messages", "Neue Person wurde eingetragen");

            return "main";
        }

        $licences = new MLicence();
        $recordSet = $licences->getLicenceList();
        $this->smarty->assign("licences", $recordSet->fetchAll());
    }


    private function editEntry()
    {
        if (isset($_POST["doEdit"])) {
            $datepart = explode(".", $_POST["birthday"]);

            $person = new MPerson();
            $person->name = $_POST["name"];
            $person->prename = $_POST["prename"];
            $person->ort = $_POST["ort"];
            $person->plz = $_POST["plz"];
            $person->address = $_POST["address"];
            $person->phone = $_POST["phone"];
            $person->mobile = $_POST["mobile"];
            $person->email = $_POST["email"];
            $person->email_parent = $_POST["email_parent"];
            $person->birthday = $datepart[2] . "-" . $datepart[1] . "-" . $datepart[0];
            $person->gender = $_POST["gender"];
            $person->ahv = $_POST["ahv"];

            if (!isset($_POST["schreiber"])) {
                $person->schreiber = 0;
            } else {
                $person->schreiber = $_POST["schreiber"];
            }

            if (!isset($_POST["sms"])) {
                $person->sms = 0;
            } else {
                $person->sms = $_POST["sms"];
            }

            if ($this->acl->isAllowed($this->session->role, "setSignature", "view")) {
                if (!isset($_POST["signature"])) {
                    $person->signature = 0;
                } else {
                    $person->signature = $_POST["signature"];
                }
            }

            $person->licence = $_POST["licence"];
            $person->licence_comment = $_POST["licence_comment"];
            if ($_POST["refid"] != '') {
              $person->refid = $_POST["refid"];
            }

            $person->update(array($person->pk => $this->data["personID"]));


            $this->smarty->assign("messages", "Die Daten wurden bearbeitet!");

            unset($_POST["doEdit"]);

            return "main";
        }

        $person = new MPerson();
        $recordSet = $person->getAddressEntry(array("persons.id =" => $this->data["personID"]));
        $this->smarty->assign("person", $recordSet->fetch());

        $licences = new MLicence();
        $recordSet = $licences->getLicenceList();
        $this->smarty->assign("licences", $recordSet->fetchAll());

        $this->smarty->assign("allowSignature", $this->acl->isAllowed($this->session->role, "setSignature", "view"));
    }
}
