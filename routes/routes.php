<?php
/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 9:38 AM
 */



$router->get('products', 'ProductController@getAll');
$router->get('product', 'ProductController@getOne');
$router->get('product/search', 'ProductController@search');
$router->post('product', 'ProductController@createProduct');
$router->put('product', 'ProductController@update');