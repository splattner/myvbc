<?php

namespace splattner\myvbc\pages;

use splattner\myvbc\models\MReport;

use \Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use \Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class PageReport extends MyVBCPage
{
    private $publicReports;

    public function __construct()
    {
        parent::__construct();
        $this->pagename = "report";
        $this->template = "report/report.tpl";

        $this->acl->allow("vorstand", ["main", "getReport", "exportReport"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);

        $this->publicReports = array("5"); //Schreibereinsätze is Public
    }

    public function mainAction()
    {
        $this->smarty->assign("subContent1", "report/overview.tpl");
        $this->smarty->assign("reportTitle", "Bericht erstellen");

        $reports = new MReport();

        $recordSet = $reports->getRS();

        $this->smarty->assign("reports", $recordSet->fetchAll());
    }

    public function getReportAction()
    {
        $reportID = $_GET["reportID"];


        if ($reportID == 5 && $this->session->isAuth) {
            $reportID = 19;
        }

        $this->smarty->assign("reportID", $reportID);

        $reports = new MReport();
        $this->smarty->assign("reportTitle", $reports->getTitle($reportID));



        if ($this->session->isAuth || in_array($reportID, $this->publicReports)) {
            switch ($reportID) {
                default:
                    $this->getDefaultReport($reportID);
                    break;
            }
        } else {
            $this->notAllowed();
        }
    }

    public function exportReportAction()
    {
        $this->enableRender = false; // Only CSV Output


        $writer = WriterEntityFactory::createCSVWriter();
        $writer->openToBrowser("export.csv");

        
        $reportID = $_GET["reportID"];

        $reports = new MReport();
        $currentReport = $reports->getReport($reportID);
        $values = $currentReport->fetchAll();

        $header = array();

        if (count($values) > 0) {
            //Build Header
            foreach ($values[0] as $title => $value) {
                if (!is_numeric($title)) {
                    $header[] = $title;
                }
            }

            $rowFromValues = WriterEntityFactory::createRowFromArray($header);
            $writer->addRow($rowFromValues);

            //Build Content
            foreach ($values as $value) {
                $row = array();
                foreach ($value as $title => $item) {
                    if (!is_numeric($title)) {
                        $row[] = $item;
                    }
                }
                
                $rowFromValues = WriterEntityFactory::createRowFromArray($row);
                $writer->addRow($rowFromValues);
            }


        }

        $writer->close();

    }

    public function getDefaultReport($reportID)
    {
        $this->smarty->assign("subContent1", "report/table.tpl");

        $reports = new MReport();

        $currentReport = $reports->getReport($reportID);
        $values = $currentReport->fetchAll();



        $header = array();
        $content = array();

        if (count($values) > 0) {
            //Build Table Header
            foreach ($values[0] as $title => $value) {
                if (!is_numeric($title)) {
                    $header[] = $title;
                }
            }
            $this->smarty->assign("tableHeader", $header);

            //Build Table Content
            foreach ($values as $value) {
                $line = array();
                foreach ($value as $title => $item) {
                    if (!is_numeric($title)) {
                        $line[$title] = $item;
                    }
                }
                $content[] = $line;
            }
            $this->smarty->assign("tableContent", $content);
        }
    }
}
