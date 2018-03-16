<?php

namespace splattner\myvbc\pages;

use splattner\myvbc\plugins\PHistory;
use splattner\myvbc\plugins\PPersondata;
use splattner\myvbc\models\MTeam;
use splattner\myvbc\models\MPerson;
use splattner\myvbc\models\MPlayer;

class PageMyteam extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "myteam";
        $this->template = "myTeam/myTeam.tpl";

        $this->acl->allow("registered", ["main",], ["view"]);
        $this->acl->allow("manager", ["addMember", "deleteMember", "edit", "new", "requestForm"], ["view"]);

        $this->acl->addResource("setSignature");
        $this->acl->allow("vorstand", ["setSignature"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);
        $this->smarty->assign("canAddMember", $this->acl->isAllowed($this->session->role, "addMember", "view"));
        $this->smarty->assign("canDeleteMember", $this->acl->isAllowed($this->session->role, "deleteMember", "view"));
        $this->smarty->assign("canEditMember", $this->acl->isAllowed($this->session->role, "edit", "view"));
    }


    public function mainAction()
    {
        $this->smarty->assign("subContent1", "myTeam/teamMember.tpl");


        $teamID = $_GET["teamID"];
        $this->smarty->assign("teamID", $teamID);

        $team = new MTeam();
        $recordSet = $team->getAllMember($teamID);

        $this->smarty->assign("persons", $recordSet->fetchAll());

        $rs_team = $team->getRS(array("id =" => $teamID));
        $currentTeam = $rs_team->fetch();

        $this->smarty->assign("teamName", $currentTeam["name"]);
    }

    public function addMemberAction()
    {
        $this->smarty->assign("subContent1", "myTeam/addMember.tpl");

        $teamID = $_GET["teamID"];
        $this->smarty->assign("teamID", $teamID);


        if (isset($_POST["doAdd"])) {
            if ($_POST["person"] != 0) {
                $player = new MPlayer();
                $player->person = $_POST["person"];
                $player->team = $teamID;
                $player->typ = $_POST["typ"];

                $player->insert();
                $this->smarty->assign("messages", "Person wurde zu Team hinzugef&uuml;gt");

                // No Update after adding to Team. This is done in model
                //$player->updateStatus();


                return "main";
            } else {
                $this->smarty->assign("messages", "Achtung: Sie haben keine Perosn ausgew&auml;hlt!");
            }
        }

        $persons = new MPerson();
        $recordSet = $persons->getRS(array(), array("name" => "ASC", "prename" => "ASC"));
        $this->smarty->assign("users", $recordSet->fetchAll());
    }

    public function deleteMemberAction()
    {
        $teamID = $_GET["teamID"];
        $personID = $_GET["personID"];

        $player = new MPlayer();
        $player->team = $teamID;
        $player->person = $personID;
        $player->delete(array("team" => $teamID, "person" => $personID));

        $this->smarty->assign("messages", "Person wurde aus Team entfernt");

        // No Update after delete
        //$player->updateStatus();

        return "main";
    }

    public function editAction()
    {
        $teamID = $_GET["teamID"];
        $this->smarty->assign("teamID", $teamID);

        $data["personID"] = $_GET["personID"];
        $this->smarty->assign("personID", $data["personID"]);

        $return = "";

        $plugin_personData = new PPersondata("persondata");
        $plugin_personData->setData($data);
        $plugin_personData->setFormURL("index.php?page={\$currentPage}&action=edit&teamID={\$teamID}&personID={\$personID}");
        $return = $plugin_personData->run("editEntry");

        // History Plugin
        $plugin_history = new PHistory("history");
        $plugin_history->setData($data);
        $plugin_history->run(null);

        $this->smarty->assign("subContent1", "myTeam/edit.tpl");

        return $return;
    }

    public function newAction()
    {
        $teamID = $_GET["teamID"];
        $this->smarty->assign("teamID", $teamID);

        $return = "";

        $plugin_personData = new PPersondata("persondata");
        $plugin_personData->setFormURL("index.php?page={\$currentPage}&action=new&teamID={\$teamID}");
        $return =  $plugin_personData->run("newEntry");

        $this->smarty->assign("subContent1", "myTeam/new.tpl");

        return $return;
    }

    public function requestFormAction()
    {
        $this->smarty->assign("subContent1", "myTeam/requestForm.tpl");


        $personID = $_GET["personID"];

        $user = new MPerson();
        $recordSet = $user->getRS(array($user->pk ." =" => $personID));
        $this->smarty->assign("person", $recordSet->fetch());
    }
}
