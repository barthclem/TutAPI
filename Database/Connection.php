<?php
/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 9:50 PM
 */

namespace App\Database;
class Connection {

    public static function make($config) {
        try{
            return new PDO("{$config['connection']}; dbname={$config['db_name']}",
                $config['username'], $config['password']);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}