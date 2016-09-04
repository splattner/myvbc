<?php
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 28.08.16
 * Time: 21:23
 */

namespace sebastianplattner\myvbc\api;
use sebastianplattner\framework\PublicAPI;
use sebastianplattner\framework\Model;
use sebastianplattner\myvbc\models\MGame;
use sebastianplattner\myvbc\models\MTeam;



class APIGame extends PublicAPI
{

    public function getGame($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        // Get Game Details
        $sql_game = "SELECT
						games.date as datum,
						teams.name as teamname,
						games.gegner as gegner,
						games.id as id,
						games.ort as ort,
						games.halle as halle
					FROM
						games
					LEFT JOIN
						teams ON teams.id = games.team
					WHERE
						games.id = ?";
        $sql_game = $this->db->Prepare($sql_game);
        $rs = $this->db->Execute($sql_game, $gameID);


        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }


    public function getGames($args = array(), $input = array()) {


        // Get ID
        if (isset($args[3]) ) {
            $teamID = $args[3];
        } else {
            $teamID = 0;
        }

        $sql = "SELECT
					games.id AS id,
					games.date AS date,
					teams.name AS name,
					games.gegner AS gegner,
					games.ort AS ort,
					games.halle AS halle,
					games.heimspiel AS heimspiel
				FROM
					games
				LEFT JOIN teams ON games.team = teams.id";

        if($teamID != 0) {
            $sql .= " WHERE
					games.team = ?";
        }
        $sql .= " ORDER BY games.date";

        $sql = $this->db->Prepare($sql);

        if($teamID != 0) {
            $rs = $this->db->Execute($sql, array($teamID));
        } else {
            $rs = $this->db->Execute($sql);
        }

        $games = $rs->getArray();


        $schreiber = new MGame();

        for ($i = 0 ; $i < count($games); $i++) {

            if($games[$i]["heimspiel"] == 1) {
                $currentSchreiber = $schreiber->getSchreiber($games[$i]["id"]);
                $arraySchreiber = $currentSchreiber->getArray();
                $games[$i]["schreiber"] = $arraySchreiber;
            } else { $games[$i]["schreiber"] = array(); }
        }


        echo json_encode($games, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);


    }

    public function getGamesFromExternal($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $teamID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $game = new MGame();
        $games = $game->getGamesFromSource($teamID);


        echo json_encode($games, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    public function importGames($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $teamID = $args[3];
        } else {
            http_response_code(400);
            return;
        }


        switch($this->method) {
            case "POST":

                $mgame = new MGame();
                $games = $mgame->getGamesFromSource($teamID);

                $team = new MTeam();
                $rs = $team->getRS(array($team->pk ." =" => $teamID));
                $team = $rs->getArray();

                foreach ($games as $game) {

                    $localgame = new MGame();

                    $localgame->extid = $game["extid"];
                    $localgame->date = $game["datum"];
                    $localgame->ort = $game["ort"];
                    $localgame->halle = $game["halle"];
                    $localgame->team = $teamID;

                    if ($game["heimteam"] == $team[0]["extname"]) {
                        $localgame->heimspiel = 1;
                        $localgame->gegner = $game["gastteam"];
                    } else {
                        $localgame->heimspiel = 0;
                        $localgame->gegner = $game["heimteam"];
                    }

                    if ($game["local"] == 1 || $game["local"] == 2) {
                        $localgame->update("extid=" . $game["extid"]);
                    } else {
                        $localgame->insert();
                    }

                }

                break;
        }




    }

    public function getTeams($args = array(), $input = array()) {


        $team = new MTeam();
        $rs = $team->getRS(array(), array("name" => "ASC"), array("id","name"));
        $teams = $rs->getArray();

        echo json_encode($teams, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

}