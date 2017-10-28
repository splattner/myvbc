<?php
namespace splattner\myvbc\services;

use splattner\framework\Service;

class ServiceSwissvolley extends Service
{
    private $soap_client;
    
    public function __construct()
    {
        $this->soap_client = new \SoapClient("http://myvolley.volleyball.ch/SwissVolley.wsdl", array('trace' => 1, 'encoding'=>' UTF-8'));
    }
    
    public function getGamesByTeamID($teamID)
    {
        $this->games_raw = $this->soap_client->getGamesTeam($teamID);
    
        $this->parseRaw();
        return $this->games;
    }
    
    public function parseRaw()
    {
        unset($this->games);
        $this->games = array();
        
        if (count($this->games_raw) > 0) {
            foreach ($this->games_raw as $game) {
                $temp = array();
                $temp["extid"] = $game->ID_game;
                $temp["datum"] = $game->PlayDate;
                $temp["heimteam"] = $game->TeamHomeCaption;
                $temp["gastteam"] = $game->TeamAwayCaption;
                $temp["ort"] = $game->HallPlace;
                $temp["halle"] = $game->HallCaption;
                
                $this->games[] = $temp;
                unset($temp);
            }
        }
    }
}
