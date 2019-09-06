<?php

namespace splattner\myvbc\models;

use splattner\framework\Application;
use splattner\framework\Model;

// no direct access
defined('_MYVBC') or die('Restricted access');



class MGame extends Model
{
    public $table = 'games';

    public function getValidSchreiber($gameID)
    {
        $schreiber = array();

        $game = new MGame();
        $rs_game = $game->getRS(array($game->pk . " =" => $gameID));
        $arr_game = $rs_game->fetch(); //All Datas for the current Game
        $currentTeam = $arr_game["team"]; // The team for the current Game


        $person = new MPerson();
        $rs_person = $person->getRS(array("schreiber =" => 1, "active =" => 1), array("name" => "ASC", "prename" => "ASC"), array("id", "name", "prename"));


        while ($row = $rs_person->fetch()) {
            $rs_teams = $person->getMyTeams($row["id"]);
            $arr_teams = $rs_teams->fetchAll();

            $personTeams = array();
            foreach ($arr_teams as $arr_team) {
                $personTeams[] = $arr_team["id"];
            }


            if (!in_array($currentTeam, $personTeams)) {
                $schreiber[] = $row;
            }
        }
        return $schreiber;
    }

    public function getSchreiber($gameID)
    {
        $sql = "
				SELECT
					persons.id as id,
					persons.prename as prename,
					persons.name as name
				FROM
					schreiber
				LEFT JOIN
					persons ON schreiber.person = persons.id
				LEFT JOIN
					games ON schreiber.game = games.id
				WHERE
					games.id = ? ";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($gameID));
        return $sql;
    }

    public function getGamesFromPersonOnDate($personID, $date)
    {
        $date = $date . "%";

        $sql = "SELECT
					games.date as date,
					games.gegner as gegner,
					games.ort as ort,
					games.halle as halle,
					games.heimspiel as heimspiel,
					teams.name as name

				FROM games
				LEFT JOIN
					players ON games.team = players.team
				LEFT JOIN
					persons ON players.person = persons.id
				LEFT JOIN
					teams ON games.team = teams.id
				WHERE
					persons.id = ?
					AND games.date like ?
				ORDER BY
					games.date";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($personID, $date));
        return $sql;
    }

    public function clearGames()
    {
        $this->pdo->query("DELETE FROM games");
    }

    public function getGamesFromSource($teamID)
    {
        $games = array();
        $team = new MTeam();
        $teamData = $team->getRS(array($team->pk ." =" => $teamID))->fetch();


        switch ($teamData["typ"]) {
            case "1":
                //Swissvolley
                $source = Application::getService("ServiceSwissvolley");
                break;
        }

        $games = $source->getGamesbyTeamID($teamData["extid"]);

        for ($i = 0 ; $i < count($games); $i++) {
            $localGame = new MGame();
            $localGames_rs = $localGame->getRS(array("extid =" => $games[$i]["extid"], "team = " => $teamID));
            $localGames = $localGames_rs->fetch();
            if ($localGames_rs->rowCount() >= 1) {
                if (strcmp($games[$i]["datum"], $localGames["date"]) !== 0 || strcmp($games[$i]["ort"], $localGames["ort"]) !== 0 || strcmp($games[$i]["halle"], $localGames["halle"]) !== 0) {
                    $games[$i]["local"] = 2;
                } else {
                    $games[$i]["local"] = 1;
                }
            } else {
                $games[$i]["local"] = 0;
            }
        }

        return $games;
    }
}
