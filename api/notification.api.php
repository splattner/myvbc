<?php
namespace splattner\myvbc\api;
use splattner\framework\PublicAPI;
use splattner\framework\Model;
use splattner\myvbc\models\MNotification;



class APINotification extends PublicAPI
{


    public function getAllNotifications($args = array()) {

        $notification = new MNotification();
        $result = $notification->getAllNotifications()->fetchAll();

        // Check if this is a DataTable
        if (isset($args[3]) && $args[3] == "dt"){
            $dataTable = array();

            $dataTable["recordsTotal"] = count($result);
            $dataTable["recordsFiltered"] = count($result);
            $dataTable["draw"] = 0;
            $dataTable["data"] = $result;
            echo json_encode($dataTable, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

            return;
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}
