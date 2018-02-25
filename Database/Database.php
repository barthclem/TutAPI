<?php

/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/21/18
 * Time: 11:21 PM
 */

namespace App\Database;
class Database
{

    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "folahan7!";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql: host= {$this->host}; dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->conn;
    }

}