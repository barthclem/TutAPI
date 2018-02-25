<?php

/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 10:49 AM
 */

namespace App\Controllers;
class ProductController
{
    private $database;
    private $db;
    private $product;
    public function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->getConnection();
        $this->product = new Product($this->db);
    }

    public function getAll() {
        $stmt = $this->product->read();
        $num = $stmt->rowCount();

        if($num > 0) {
            $product_array = array();
            $product_array["records"] = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $product_item = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "description" => html_entity_decode($row['description']),
                    "price" => $row['price'],
                    "category_id" => $row['category_id'],
                    "category_name" => $row['category_name']
                );

                array_push($product_array["records"], $product_item);
            }

            echo json_encode($product_array);
        } else {
            echo json_decode(array("message" => "product not exist"));
        }
    }

    public function getOne(){
        $this->product->id = isset($_GET['id'])? $_GET['id'] : die();
        $this->product->readOne();

        $product_arr = array(
            "id" => $this->product->id,
            "name" => $this->product->name,
            "description" => $this->product->description,
            "price" => $this->product->price,
            "category_id" => $this->product->category_id,
            "category_name" => $this->product->category_name
        );

        print_r(json_encode($product_arr));
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"));

        $this->product->id = $data->id;
        $this->product->name = $data->name;
        $this->product->price = $data->price;
        $this->product->description = $data->description;
        $this->product->category_id = $data->category_id;

        if($this->product->update()){
            echo "{";
            echo '"message": "product was updated"';
            echo "}";
        } else {
            echo "{";
            echo '"message": "product was not updated"';
            echo "}";
        }
    }

    public function createProduct() {
        $data = json_decode(file_get_contents("php://input"));

        $this->product->name = $data->name;
        $this->product->price = $data->price;
        $this->product->description = $data->description;
        $this->product->category_id = $data->category_id;
        $this->product->category_name = $data->category_name;
        $this->product->created = date('Y-m-d H:i:s');

        if($this->product->create()){
            echo "{";
            echo '"message": "product was created"';
            echo "}";
        } else {
            echo "{";
            echo '"message": "product was created"';
            echo "}";
        }
    }

    public function search() {

        $keywords = isset($_GET['s'])? $_GET['s'] : die();

        $stmt = $this->product->search($keywords);
        $num = $stmt->rowCount();

        if($num > 0) {
            $product_array = array();
            $product_array["records"] = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract($row);

                $product_item = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "description" => html_entity_decode($row['description']),
                    "price" => $row['price'],
                    "category_id" => $row['category_id'],
                    "category_name" => $row['category_name']
                );

                array_push($product_array["records"], $product_item);
            }

            echo json_encode($product_array);
        } else {
            echo json_decode(array("message" => "product not found"));
        }
    }
}