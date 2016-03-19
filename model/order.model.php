<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

MyModel::loadModel("person");

class MOrder extends MyModel {
	public $table = 'order';
	
	
	public function addLicenceToOrder($personID, $orderID) {
		
		$sql = "INSERT INTO 
					orderitem (orderid, personid) 
				VALUES(
					" . $this->db->qstr($orderID) . ",
					" . $this->db->qstr($personID) . ")";
		$this->db->Execute($sql);
		
		$sql = "UPDATE orderitem SET 
					licence_id = (SELECT persons.licence FROM persons WHERE persons.id = " . $this->db->qstr($personID) . "),
					licence_comment = (SELECT persons.licence_comment FROM persons WHERE persons.id = " . $this->db->qstr($personID) . ")
				WHERE
					orderid = " . $this->db->qstr($orderID) . "
					AND personid = " . $this->db->qstr($personID);
		$this->db->Execute($sql);
	}
	
	public function removeLicenceFromOrder($personID, $orderID) {
		
		$sql = "DELETE FROM 
					orderitem
				WHERE
					orderid = " . $this->db->qstr($orderID) . " AND
					personid = " . $this->db->qstr($personID);
		$this->db->Execute($sql);
	}
	
	public function getOrder($orderID = "") {
		
		$sql = "SELECT 
					order.id AS id,
					order.createdate AS createdate,
					order.lastupdate as lastupdate,
					order.status AS status,
					orderstatus.description AS statustext,
					CONCAT(persons.prename, ' ', persons.name) AS ownername,
					order.owner AS owner,
					order.comment as comment
				FROM 
					`" . $this->table . "`
				LEFT JOIN
					persons ON order.owner = persons.id
				LEFT JOIN
					orderstatus ON order.status = orderstatus.id";
		
		
		
			
		if ($orderID != "") {
			$sql .= " WHERE order.id = " . $this->db->qstr($orderID);
		}
		
		$sql .= " ORDER BY order.status ASC, order.lastupdate DESC";
		
		
		
		return $this->db->Execute($sql);
	}
	
	public function getPersonOrders($personID) {
		$sql = "SELECT
				order.createdate as 'date',
				orderstatus.status as 'status',
				order.comment as 'order_comment',
				licences.typ as 'licence'
			FROM
				orderitem
			LEFT JOIN
				`order` ON orderitem.orderid = order.id
			LEFT JOIN
				orderstatus ON order.status = orderstatus.id
			LEFT JOIN
				licences ON orderitem.licence_id = licences.id
			WHERE
				orderitem.personid = " . $this->db->qstr($personID);
		
		return $this->db->Execute($sql);
	}

	
	public function getOrderItems($orderID) {
		$sql = "SELECT
					order.id AS orderID,
					persons.id AS personID,
					order.status AS status,
					persons.name AS name,
					persons.prename AS prename,
					licences.typ AS licence,
					orderitem.licence_comment AS comment
				FROM
					`orderitem`
				LEFT JOIN
					`order` ON orderitem.orderid = order.id
				LEFT JOIN
					`persons` ON orderitem.personid = persons.id
				LEFT JOIN
					`licences` ON orderitem.licence_id = licences.id
				WHERE
					order.id = " . $this->db->qstr($orderID) . "
				ORDER BY persons.name ASC, persons.prename ASC";
		
		return $this->db->Execute($sql);
	}
	
	public function getStatusList() {
		$sql = "SELECT
					*
				FROM
					orderstatus";
		
		return $this->db->Execute($sql);
	}
	
	public function updateStatus($statusID, $orderID) {
		$sql = "UPDATE 
					`order`
				SET status = " . $this->db->qstr($statusID) . ", lastupdate = NOW() WHERE id = " . $this->db->qstr($orderID);
		$this->db->Execute($sql);
		
		/* Add Notifications if order is complete */
		if ($statusID == 4) {

			$notification = MyApplication::getInstance("notification");
			
			$sql = "SELECT
						personid
					FROM
						orderitem
					WHERE
						orderid = " . $this->db->qstr($orderID);
			$rs = $this->db->Execute($sql);
			$personids = $rs->getArray();
			
			$mperson = new MPerson();
			foreach($personids as $person) {
				
				$mperson->setChanged($person["personid"], 0); // Reset Change Status
				$notification->addNewLicenceNotification($person["personid"]);
			}
		}
		
		if($statusID == 2) {
			$notification = MyApplication::getInstance("notification");
			$notification->addNewOrderNotification();
		}
		
	}
	
	public function addNewOrder() {
		$sql = "INSERT INTO 
					`order` (createdate, lastupdate, status, comment, owner)
				VALUES (
					NOW(),
					NOW(),
					1,
					" . $this->db->qstr($this->comment) . ",
					" . $this->session->uid . ")";
		$this->db->Execute($sql);
		
		return $this->db->Insert_ID();
		
	}
}

?>
