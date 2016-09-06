<?php

namespace splattner\myvbc\pages;
use splattner\myvbc\models\MNotification;



class PageNotification extends MyVBCPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "notification";
		$this->template = "notification/notification.tpl";
		

	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
				
	}
	
	public function cleanup() {
		parent::cleanup();
	}
	

	
	public function mainAction() {
		$this->smarty->assign("subContent1", "notification/notificationTable.tpl");
		
		$notification = new MNotification();
		$rs = $notification->getNotificationStatus($this->session->uid);
		$this->smarty->assign("notifications", $rs->getArray());
		
	}
	
	public function deleteAction() {
		
		$notificationID = $_GET["notificationID"];
		
		$notification = new MNotification();
		$notification->deleteNotificationStatus($notificationID, $this->session->uid);
		
		return "main";
	}
}
