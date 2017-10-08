<?php
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 27.08.16
 * Time: 14:34
 */

namespace splattner\myvbc\api;
use splattner\framework\PublicAPI;
use splattner\framework\Model;
use splattner\myvbc\models\MOrder;
use splattner\myvbc\models\MPerson;




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
        echo json_encode($order->getOrderItems($orderID)->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

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
        echo json_encode($order->getOrder($orderID)->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    }

    public function getStatusList($args = array(), $input = array()) {

        $order = new MOrder();
         echo json_encode($order->getStatusList()->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

    public function getAllPersons($args = array(), $input = array()) {
        $person = new MPerson();
        $recordSet = $person->getRS(array("active =" => "1", "signature =" => "1"),array("persons.name" => "ASC", "persons.prename" => "ASC"), array("id","name","prename"));

        echo json_encode($recordSet->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

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

        echo json_encode($order->getOrder($orderID)->fetch(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);


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
        $orderdetail = $order->getRS(array($order->pk ." =" => $orderID))->fetch();


        if ($orderdetail["status"] != $input["status"]) {
            $order->updateStatus($input["status"], $orderID);
        }

        $orderdetail = $order->getRS(array($order->pk ." =" => $orderID))->fetch();

        echo json_encode($orderdetail[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }


}