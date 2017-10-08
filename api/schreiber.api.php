<?php
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 30.08.16
 * Time: 20:10
 */


namespace splattner\myvbc\api;
use splattner\framework\PublicAPI;
use splattner\framework\Model;
use splattner\myvbc\models\MSchreiber;
use splattner\myvbc\models\MGame;
use splattner\myvbc\models\MPerson;

class APISchreiber extends PublicAPI
{

    public function getSchreiberProposal($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
            $schreiber = new MSchreiber();

            echo json_encode($schreiber->getSchreiberProposal($gameID)->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            return;
        }

        http_response_code(400);
    }

    public function getSchreiber($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];

            $game = new MGame();
            echo json_encode($game->getSchreiber($gameID)->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

            return;
        } 

        http_response_code(400);
    }

    public function getValidSchreiber($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];

            $game = new MGame();
            echo json_encode($game->getValidSchreiber($gameID), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

            return;
        }
        http_response_code(400);

    }

    public function changeSchreiber($args = array(), $input = array()) {
        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $schreiber = new MSchreiber();

        switch($this->method) {
            case "POST":
                $schreiber->addSchreiber($input["personID"], $gameID);
                break;
            case "DELETE":

                // Get PersonID
                if (isset($args[4]) ) {
                    $personID = $args[4];
                } else {
                    http_response_code(400);
                    return;
                }

                $schreiber->removeSchreiber($personID, $gameID);

                break;
        }

    }

    public function getSchreiberInfo($args = array(), $input = array()) {


        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        // Get PersonID
        if (isset($args[4]) ) {
            $personID = $args[4];
        } else {
            http_response_code(400);
            return;
        }

        $game = new MGame();
        $currentGame = $game->getRS(array($game->pk ." =" => $gameID))->fetch();

        //the number of events this person already has
        $person = new MPerson();
        $schreiber = $person->getMySchreibers($personID)->fetchAll();

        $result = array();
        $result["count"] = count($schreiber);


        //Get Games on the Same day!
        list($datum, $zeit) = explode(" ", $currentGame["date"]);
        $rs_games = $game->getGamesFromPersonOnDate($personID, $datum);
        $games = $rs_games->fetchAll();

        $result["games"] = $games;

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

}