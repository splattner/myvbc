<?php

namespace splattner\myvbc\pages;

use splattner\myvbc\models\MPerson;
use splattner\myvbc\plugins\PHistory;
use splattner\myvbc\plugins\PPersondata;

class PageAddress extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "address";
        $this->template = "address/address.tpl";

        $this->noACL["import"] = true;

        $this->acl->allow("vorstand", ["main","edit","new","delete","setState","setSignature","import","requestForm"], ["view"]);
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

        if ($state == 0) {
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

    public function importAction()
    {
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
