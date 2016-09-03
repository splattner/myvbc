<?php

MyModel::loadModel("person");

/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 26.08.16
 * Time: 13:33
 */
class APIAddress extends PublicAPI
{


    public function getAddresses($args = array(), $input = array()) {

        $person = new MPerson();
        $where = array();
        $orderby = array();

        // Get ID
        if (isset($args[3]) && $args[3] != "dt") {
            $where[$person->table . "." . $person->pk . " ="] = $args[3];
        }

        $orderby = array();
        $orderby["persons.active"] = "DESC";
        $orderby["persons.name"] = "ASC";
        $orderby["persons.prename"] = "ASC";



        $result = $person->getAddressEntry($where, $orderby)->getArray();

        // Extract temas (as Json) for proper JSON encode
        for ($i = 0 ; $i < count($result); $i++) {
            $result[$i]["teams"] = json_decode($result[$i]["teams"], true);
        }

        if (isset($args[3]) && $args[3] == "dt") {
            $dataTables = true;
        }

        if ($dataTables){
            $dt = array();

            $dt["recordsTotal"] = count($result);
            $dt["recordsFiltered"] = count($result);
            $dt["draw"] = 0;
            $dt["data"] = $result;
            echo json_encode($dt, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);



        } else {
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

        }



    }
}