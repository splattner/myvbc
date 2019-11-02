<?php

namespace splattner\myvbc\pages;

use splattner\myvbc\models\MTeam;
use splattner\myvbc\models\MPlayer;
use splattner\myvbc\models\MPerson;

class PageTeam extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "team";
        $this->template = "team/team.tpl";


        $this->acl->allow("vorstand", ["main", "edit","member","deleteMember","addMember","new","delete"], ["view"]);
        $this->acl->allow("manager", ["main","member"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);
    }




    public function mainAction()
    {
        $this->smarty->assign("subContent1", "team/teamTable.tpl");

        $teams = new MTeam();
        $recordSet = $teams->getRS(array(), array("teams.name" => "ASC"));

        $this->smarty->assign("teams", $recordSet->fetchAll());

        $this->smarty->assign("canAddTeam", $this->acl->isAllowed($this->session->role, "new", "view"));
        $this->smarty->assign("canViewTeam", $this->acl->isAllowed($this->session->role, "member", "view"));
        $this->smarty->assign("canEditTeam", $this->acl->isAllowed($this->session->role, "edit", "view"));
        $this->smarty->assign("canDeleteTeam", $this->acl->isAllowed($this->session->role, "delete", "view"));
    }

    public function editAction()
    {
        $this->smarty->assign("subContent1", "team/edit.tpl");

        $teamID = $_GET["teamID"];

        if (isset($_POST["doEdit"])) {
            $team = new MTeam();
            $team->extid = $_POST["extid"];
            $team->name = $_POST["name"];
            $team->extname = $_POST["extname"];
            $team->liga = $_POST["liga"];
            $team->extliga = $_POST["extliga"];
            $team->typ = $_POST["typ"];


            $team->update(array($team->pk => $teamID));

            return "main";
        }

        $team = new MTeam();
        $recordSet = $team->getRS(array($team->pk ." =" => $teamID));


        $this->smarty->assign("teams", $recordSet->fetchAll());
    }

    public function memberAction()
    {
        $this->smarty->assign("subContent1", "team/memberTable.tpl");

        $teamID = $_GET["teamID"];
        $this->smarty->assign("teamID", $teamID);

        $team = new MTeam();
        $recordSet = $team->getAllMember($teamID);
        $this->smarty->assign("persons", $recordSet->fetchAll());

        $recordSet = $team->getRS(array($team->pk ." =" => $teamID));
        $currentTeam = $recordSet->fetch();
        $teamName = $currentTeam["name"];
        $this->smarty->assign("teamName", $teamName);

        $this->smarty->assign("canAddMember", $this->acl->isAllowed($this->session->role, "addMember", "view"));
        $this->smarty->assign("canDeleteMember", $this->acl->isAllowed($this->session->role, "deleteMember", "view"));
    }

    public function deleteMemberAction()
    {
        $teamID = $_GET["teamID"];
        $personID = $_GET["personID"];

        $player = new MPlayer();
        $player->person = $personID;
        $player->team = $teamID;
        $player->delete(array("team" => $teamID, "person" => $personID));

        // No Update after delete
        //$player->updateStatus();

        return "member";
    }

    public function addMemberAction()
    {
        $this->smarty->assign("subContent1", "team/addMember.tpl");

        $teamID = $_GET["teamID"];
        $this->smarty->assign("teamID", $teamID);


        if (isset($_POST["doAdd"])) {
            if ($_POST["person"] != 0) {
                $player = new MPlayer();
                $player->person = $_POST["person"];
                $player->team = $_GET["teamID"];
                $player->typ = $_POST["typ"];

                $player->insert();

                // No Update after adding to Team. This is done in model
                //$player->updateStatus();

                $this->smarty->assign("messages", "Person wurde zu Team hinzugef&uuml;gt");

                return "member";
            } else {
                $this->smarty->assign("messages", "Achtung: Sie haben keine Perosn ausgew&auml;hlt!");
            }
        }

        $persons = new MPerson();
        $recordSet = $persons->getRS(array(), array("name" => "ASC", "prename" => "ASC"));
        $this->smarty->assign("users", $recordSet->fetchAll());
    }

    public function newAction()
    {
        if (isset($_POST["doNew"])) {
            $team = new MTeam();
            $team->extid = $_POST["extid"];
            $team->name = $_POST["name"];
            $team->extname = $_POST["extname"];
            $team->liga = $_POST["liga"];
            $team->extliga = $_POST["extliga"];
            $team->typ = $_POST["typ"];


            $team->insert();

            $this->smarty->assign("messages", "Neues Team wurde eingetragen");

            return "main";
        }
    }

    public function deleteAction()
    {
        $teamID = $_GET["teamID"];

        $team = new MTeam();
        $team->delete(array("id" => $teamID));

        $player = new MPlayer();
        $player->updateStatus();

        $this->smarty->assign("messages", "Team wurde gel&ouml;scht");

        return "main";
    }
}
