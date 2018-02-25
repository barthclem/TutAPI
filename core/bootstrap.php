<?php
/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 10:40 PM
 */

//
//require "core/Router.php";
//require "core/Request.php";
//include "config/Database.php";
//include "Models/Product.php";

App::bind('config', require "config/config.php");


App::bind('product', new Product(
    Connection::make(App::get('config')['database'])
));
