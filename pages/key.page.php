<?php

namespace sebastianplattner\myvbc\pages;
use sebastianplattner\framework\Page;
use sebastianplattner\framework\Model;

use sebastianplattner\myvbc\models\MPerson;
use sebastianplattner\myvbc\models\MKey;



class PageKey extends Page
{

    public function __construct() {
        parent::__construct();
        $this->pagename = "key";
        $this->template = "key/index.tpl";
    }

    public function init() {
        parent::init();
        $this->smarty->assign("content", $this->template);

    }

    public function mainAction() {

        $this->smarty->assign("subContent1", "key/keyTable.tpl");

        $keys = new MKey();
        $rs = $keys->getAllKeys();

        $this->smarty->assign("keys", $rs->getArray());

        $persons = new MPerson();
        $rs = $persons->getRS(array(),array("name" => "ASC", "prename" => "ASC"));
        $this->smarty->assign("users", $rs->getArray());

    }

    public function newAction() {

        if (isset($_POST["doNew"])) {

            $key = new MKey();
            $key->person = $_POST["person"];
            $key->label = $_POST["label"];
            $key->nr = $_POST["nr"];


            $key->insert();

            $this->smarty->assign("messages","Schl&uuml;ssel wurde hinzugef&uuml;gt");

            return "main";
        }

        return "main";
    }

    public function deleteAction() {

        $keyID = $_GET["keyID"];

        $key = new MKey();
        $key->delete(array("id" => $keyID));


        $this->smarty->assign("messages","Schl&uuml;ssel wurde gel&ouml;scht");

        return "main";
    }
}

?>
