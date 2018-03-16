<?php

namespace splattner\myvbc\models;

use splattner\framework\Model;

// no direct access
defined('_MYVBC') or die('Restricted access');


class MReport extends Model
{
    public $table = 'reports';


    public function getReport($reportID)
    {
        $recordSet = $this->getRS(array("id =" => $reportID));
        $currentReport = $recordSet->fetch();

        $sql = $currentReport["query"];

        return $this->pdo->query($sql);
    }

    public function getTitle($reportID)
    {
        $recordSet = $this->getRS(array("id =" => $reportID));
        $currentReport = $recordSet->fetch();

        return $currentReport["title"];
    }
}
