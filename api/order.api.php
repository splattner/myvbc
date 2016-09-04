<?php
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 27.08.16
 * Time: 14:34
 */

namespace sebastianplattner\myvbc\api;
use sebastianplattner\framework\PublicAPI;
use sebastianplattner\framework\Model;
use sebastianplattner\myvbc\models\MOrder;
use sebastianplattner\myvbc\models\MPerson;




class APIOrder extends PublicAPI
{

    public function getItemsEntry($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $orderID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $order = new MOrder();

        $rs = $order->getOrderItems($orderID);

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    }

    public function getOrder($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) ) {
            $orderID = $args[3];
        } else {
            http_response_code(400);
            return;
        }

        $order = new MOrder();

        $rs = $order->getOrder($orderID);

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    }

    public function getStatusList($args = array(), $input = array()) {

        $order = new MOrder();
        $rs = $order->getStatusList();

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

    public function getAllPersons($args = array(), $input = array()) {
        $person = new MPerson();
        $rs = $person->getRS(array("active =" => "1", "signature =" => "1"),array("persons.name" => "ASC", "persons.prename" => "ASC"), array("id","name","prename"));

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    }

    public function orderItem($args = array(), $input = array()) {


        $order = new MOrder();


        switch($this->method) {
            case "POST":
                $order->addLicenceToOrder($input["personID"], $input["orderID"]);

                break;
            case "DELETE":

                // Get ID
                if (isset($args[3]) ) {
                    $orderID = $args[3];
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

                $order->removeLicenceFromOrder($personID, $orderID);

                break;
        }
    }

    public function updateStatus($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3]) && isset($input["status"]) ) {
            $orderID = $args[3];
        } else {
            http_response_code(400);
            return;
        }


        $order = new MOrder();
        $order->updateStatus(intval($input["status"]), $orderID);

        $rs = $order->getOrder($orderID);

        echo json_encode($rs->getArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);


    }

    public function updateOrder($args = array(), $input = array()) {

        // Get ID
        if (isset($args[3])) {
            $orderID = $args[3];
        } else {
            http_response_code(400);
            return;
        }


        $order = new MOrder();
        $order->comment = $input["comment"];

        $order->update(array($order->pk => $orderID));

        $orderdetail = $order->getRS(array($order->pk ." =" => $orderID))->getArray();



        if ($orderdetail[0]["status"] != $input["status"]) {
            $order->updateStatus($input["status"], $orderID);
        }

        $orderdetail = $order->getRS(array($order->pk ." =" => $orderID))->getArray();

        echo json_encode($orderdetail[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }


}