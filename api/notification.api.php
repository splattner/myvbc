<?php
namespace splattner\myvbc\api;
use splattner\framework\PublicAPI;
use splattner\framework\Model;
use splattner\myvbc\models\MNotification;



class APINotification extends PublicAPI
{


    public function getAllNotifications($args = array(), $input = array()) {

        $notification = new MNotification();
        $result = $notification->getAllNotifications()->fetchAll();

        // Check if this is a DataTable
        if (isset($args[3]) && $args[3] == "dt"){
            $dt = array();

            $dt["recordsTotal"] = count($result);
            $dt["recordsFiltered"] = count($result);
            $dt["draw"] = 0;
            $dt["data"] = $result;
            echo json_encode($dt, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

            return;
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}