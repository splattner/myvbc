<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

MyModel::loadModel("person");

class MOrder extends MyModel {
	public $table = 'order';
	
	
	public function addLicenceToOrder($personID, $orderID) {
		
		$sql = "INSERT INTO 
					orderitem (orderid, personid) 
				VALUES(?,?)";
		$sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($orderID, $personID));
		
		$sql = "UPDATE orderitem SET 
					licence_id = (SELECT persons.licence FROM persons WHERE persons.id = ?),
					licence_comment = (SELECT persons.licence_comment FROM persons WHERE persons.id = ?)
				WHERE
					orderid = ?
					AND personid = ?";

		$sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($personID, $personID, $orderID, $personID));
	}
	
	public function removeLicenceFromOrder($personID, $orderID) {
		
		$sql = "DELETE FROM 
					orderitem
				WHERE
					orderid = ? AND
					personid = ?";
		$sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($orderID, $personID));
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
			$sql .= " WHERE order.id = ?";
		}
		
		$sql .= " ORDER BY order.status ASC, order.lastupdate DESC";

		$sql = $this->db->Prepare($sql);

		if ($orderID != "") {
			return $this->db->Execute($sql, array($orderID));
		} else {
			return $this->db->Execute($sql);
		}
	}
	
	public function getPersonOrders($personID) {
		$sql = "SELECT
				order.createdate as 'date',
				orderstatus.id as 'status',
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
				orderitem.personid = ?";

		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($personID));
	}

	
	public function getOrderItems($orderID) {
		$sql = "SELECT
					order.id AS orderID,
					orderitem.id as orderitemid,
					persons.id AS personID,
					persons.name AS name,
					persons.prename AS prename,
					licences.typ AS licence,
					licences.id as licenceID,
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
					order.id = ?
				ORDER BY persons.name ASC, persons.prename ASC";

		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($orderID));
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
				SET status = ?, lastupdate = NOW() WHERE id = ?";
		$this->db->Prepare($sql);
		$this->db->Execute($sql, array($statusID, $orderID));
		
		/* Add Notifications if order is complete */
		if ($statusID == 4) {

			$notification = MyApplication::getInstance("notification");
			
			$sql = "SELECT
						personid
					FROM
						orderitem
					WHERE
						orderid = ?";
			$sql = $this->db->Prepare($sql);
			$rs = $this->db->Execute($sql, array($orderID));
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
					?,
					" . $this->session->uid . ")";
        $sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($this->comment));
		
		return $this->db->Insert_ID();
		
	}
}

?>
