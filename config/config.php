<?php
/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 9:32 PM
 */


return [
    "database" => [
        "host" => "localhost",
        "db_name" => "api_db",
        "username" => "root",
        "password" => "folahan7!",
        "connection" => "mysql:host=127.0.0.1",
        "options" => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];