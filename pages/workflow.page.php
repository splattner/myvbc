<?php
MyModel::loadModel("workflow");


class PageWorkflow extends MyPage {
	
	
	private $publicReports;
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "workflow";
		$this->template = "workflow/workflow.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
		

	}
	
	public function mainAction() {
		$this->smarty->assign("subContent1", "workflow/overview.tpl");
		
		$workflows = new MWorkflow();

		$rs =$workflows->getAllWorkflows();

		$this->smarty->assign("workflows", $rs->getArray());
	}
	
}
?>
