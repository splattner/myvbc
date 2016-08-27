<?php

/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 26.08.16
 * Time: 13:38
 */
class PublicAPI
{

    /**
     * Manage the db connection
     * @access public
     * @var mixed
     */
    public $db;


    public function __construct()
    {
        header('Content-type: application/json');

        $this->db = MyApplication::getInstance("db");
        $this->db->setFetchMode(ADODB_FETCH_ASSOC);
    }

}