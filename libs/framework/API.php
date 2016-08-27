<?php

/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 25.08.16
 * Time: 16:56
 */
class API
{


    /**
     * Contains all global config options defindet in /etc/confic.inc.php
     * @access public
     * @var mixed
     */
    public $config;

    /**
     * Manage the db connection
     * @access public
     * @var mixed
     */
    public $db;

    /**
     * The Session object to manage all Session related stuff
     * @access public
     * @var mixed
     */
    public $session;



    private $method;
    private $input;
    private $request;


    public function __construct() {

        $this->config = MyApplication::getInstance("config");
        $this->db = MyApplication::getInstance("db");
        $this->session = MyApplication::getInstance("session");



    }

    public function call() {

        header('Content-type: application/json');

        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        $this->input = json_decode(file_get_contents('php://input'), true);

        $apiCall = $this->request[1];



        $modelFile = "model/" . $apiCall . ".model.php";
        $apiFile = "api/" . $apiCall . ".api.php";


        // REST API for a Model
        if(file_exists($modelFile)) {
            include_once $modelFile;
            $modelClass = "M" . $apiCall;
            $model =  new $modelClass();

            if (count($this->request) > 2) {
                $id = $this->request[2];
            } else {
                $id = 0;
            }

            switch($this->method) {
                case 'GET':
                    $model->api_get($id);
                    break;
                case 'PUT':
                    $model->api_put($id, $this->input);
                    break;
                case 'POST':
                    $model->api_post($this->input);
                    break;
                case 'DELETE':
                    $model->api_delete($id);
                    break;
            }
        } else { // REST API with specific functions
            if(file_exists($apiFile)) {
                include_once $apiFile;
                $APIClass = "API" . $apiCall;
                $api =  new $APIClass();


                if (isset($this->request[2])) {
                    $function = $this->request[2];

                    $api->$function($this->request, $this->input);
                }

            }

        }



    }




}