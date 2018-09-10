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

use splattner\myvbc\models\MConfig;



class APITeamimport extends PublicAPI
{

    public function getTeamsByClub($args = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $clubId = $args[3];
        } else {
            $mconfig = new MConfig();
            $result = $mconfig->getRS(array("`key` =" =>"clubId"))->fetchAll()[0];
            $clubId = $result["value"];
            if ($clubId == "") {
              http_response_code(400);
              return;
            }
        }

        $sw = Application::getService("ServiceSwissvolley");

        $teams = $sw->getTeamsByClub($clubId);


        echo json_encode($teams, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }




}
