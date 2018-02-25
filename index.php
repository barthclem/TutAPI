<?php
/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 9:41 AM
 */

//
//
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type,
//Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "vendor/autoload.php";
require "core/bootstrap.php";



$router = new Router;

require $router::load('routes/routes.php')
    ->direct(Request::uri(), Request::method());