<?php
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 28.08.16
 * Time: 21:23
 */

namespace splattner\myvbc\api;
use splattner\framework\PublicAPI;
use splattner\framework\Model;
use splattner\framework\Application;
use splattner\myvbc\models\MGame;
use splattner\myvbc\models\MTeam;
use splattner\myvbc\models\MPerson;



class APIGame extends PublicAPI
{

    public function getGame($args = array()) {

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
        $sql_game = $this->pdo->Prepare($sql_game);
        $sql_game->Execute(array($gameID));


        echo json_encode($sql_game->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }


    public function getGames($args = array()) {


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

        $sql = $this->pdo->Prepare($sql);

        if($teamID != 0) {
            $sql->Execute(array($teamID));
        } else {
            $sql->Execute();
        }

        $games = $sql->fetchAll();


        $schreiber = new MGame();

        for ($i = 0 ; $i < count($games); $i++) {

            if($games[$i]["heimspiel"] == 1) {
                $currentSchreiber = $schreiber->getSchreiber($games[$i]["id"]);
                $arraySchreiber = $currentSchreiber->fetchAll();
                $games[$i]["schreiber"] = $arraySchreiber;
            } else { $games[$i]["schreiber"] = array(); }
        }


        echo json_encode($games, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);


    }

    public function getGamesFromExternal($args = array()) {

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

    public function getGameDetailed($args = array()) {
      // Get ID
      if (isset($args[3]) ) {
          $gameID = $args[3];
      } else {
          http_response_code(400);
          return;
      }

      $sw = Application::getService("ServiceSwissvolley");
      $teams = $sw->getGameDetailed($gameID);


      echo json_encode($games, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    public function importGames($args = array()) {

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
                $recordSet = $team->getRS(array($team->pk ." =" => $teamID));
                $team = $recordSet->fetch();

                foreach ($games as $game) {

                    $localgame = new MGame();

                    $localgame->extid = $game["extid"];
                    $localgame->date = $game["datum"];
                    $localgame->ort = $game["ort"];
                    $localgame->halle = $game["halle"];
                    $localgame->team = $teamID;

                    if ($game["heimteam"] == $team["extname"]) {
                        $localgame->heimspiel = 1;
                        $localgame->gegner = $game["gastteam"];
                    } else {
                        $localgame->heimspiel = 0;
                        $localgame->gegner = $game["heimteam"];
                    }

                    if ($game["local"] == 1 || $game["local"] == 2) {
                        $localgame->update(array("extid" => $game["extid"]));

                    } else {
                        $localgame->insert();
                    }

                }

                break;
        }




    }

    public function getTeams($args = array()) {


        $team = new MTeam();
        $teams = $team->getRS(array(), array("name" => "ASC"), array("id","name"))->fetchAll();

        echo json_encode($teams, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

}
