<?php
MyModel::loadModel("schreiber");
MyModel::loadModel("game");
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 30.08.16
 * Time: 20:10
 */
class APISchreiber extends PublicAPI
{

    public function getSchreiberProposal($args = array(), $input = array()) {


        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $schreiber = new MSchreiber();
        $rs = $schreiber->getSchreiberProposal($gameID);

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    public function getSchreiber($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $game = new MGame();
        $rs = $game->getSchreiber($gameID);

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);


    }

    public function getValidSchreiber($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $gameID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $game = new MGame();
        $schreiber = $game->getValidSchreiber($gameID);

        echo json_encode($schreiber, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);


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
        $rs_currentGame = $game->getRS(array($game->pk ." =" => $gameID));
        $currentGame = $rs_currentGame->getArray();

        //the number of events this person already has
        $person = new MPerson();
        $rs_schreiber = $person->getMySchreibers($personID);
        $schreiber = $rs_schreiber->getArray();

        $result = array();
        $result["count"] = count($schreiber);


        //Get Games on the Same day!
        list($datum, $zeit) = explode(" ", $currentGame[0]["date"]);
        $rs_games = $game->getGamesFromPersonOnDate($personID, $datum);
        $games = $rs_games->getArray();


        $result["games"] = $games;

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

}