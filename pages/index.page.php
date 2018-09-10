<?php

namespace splattner\myvbc\pages;

use splattner\framework\Application;
use splattner\myvbc\models\MPerson;
use splattner\myvbc\models\MKey;

class PageIndex extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "index";
        $this->template = "index/index.tpl";

        $this->acl->allow("guest", ["main"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);
    }


    public function mainAction()
    {
        if ($this->session->isAuth) {
            $user = new MPerson();
            $recordSet = $user->getRS(array($user->pk ." =" => $this->session->uid));
            $currentUser = $recordSet->fetch();

            $this->smarty->assign("user", $currentUser);


            /*
             * Get myGames
             */
            $currentGames = $user->getMyGames($this->session->uid);
            $myGames = array();
            while ($currentGame = $currentGames->fetch()) {
                $myGames[] = $currentGame;
            }
            $this->smarty->assign("myGames", $myGames);

            /*
             * Get myTeams
             */
            $currentTeams = $user->getMyTeams($this->session->uid);
            $myTeams = array();
            while ($currentTeam = $currentTeams->fetch()) {
                $myTeams[] = $currentTeam;
            }
            $this->smarty->assign("myTeams", $myTeams);

            /*
             * Get mySchreiber
             */
            $currentSchreibers= $user->getMySchreibers($this->session->uid);
            $mySchreibers = array();
            while ($currentSchreiber = $currentSchreibers->fetch()) {
                $mySchreibers[] = $currentSchreiber;
            }
            $this->smarty->assign("mySchreibers", $mySchreibers);


            /*
             * Get myKeys
             */
            $keys = new MKey();
            $mykeys = $keys->getMyKeys($this->session->uid);


            $this->smarty->assign("keys", $mykeys);
        }
    }
}
