<?php

global $config;
global $pdo;

return array("paths" => array(
            "migrations" => "db/migrations",
            "seeds" => "db/seeds",
        ),
		'environments' =>
         array(
           'default_database' => 'production',
           'production' => array(
             'name' => $config["db"]["database"],
             'connection' => $pdo
           )
         )
       );

?>