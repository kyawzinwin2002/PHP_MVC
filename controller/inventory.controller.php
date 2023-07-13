<?php

function index() {
    $sql = "SELECT * FROM  inventories";
    if(!empty($_GET["q"])){
        $q= $_GET["q"];
        $sql .= " WHERE name LIKE '%$q%'";
    }   
  
    return view("inventory/index",["lists" => paginate($sql,10)]);
};

function create() {
   return view("inventory/create");
};

function store() {       
    
    validationStart();

    if(empty(trim($_POST["name"]))){
        setError("name","name is required");
    }else if(strlen($_POST["name"]) < 3){
        setError("name","name is too short");
    }else if(strlen($_POST["name"]) > 100){
        setError("name","name is too long");
    }else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST["name"])){
        setError("name","name is only allowed number , character and space");
    }

    if(empty(trim($_POST["price"]))){
        setError("price","price is required",);
    }else if(!is_numeric($_POST["price"])){
        setError("price","price must be numeric");
    }else if($_POST["price"] < 100){
        setError("price","price must be greater than 100");
    }else if($_POST["price"] > 99999){
        setError("price","price must be less than 99999");
    }

    if(empty(trim($_POST["stock"]))){
        setError("stock","stock is required",);
    }else if(!is_numeric($_POST["stock"])){
        setError("stock","stock must be numeric");
    }else if($_POST["stock"] < 1){
        setError("stock","stock must be greater than 1");
    }else if($_POST["stock"] > 100){
        setError("stock","stock must be less than 100");
    }

    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $sql = "INSERT INTO inventories (name,price,stock) VALUES ('$name',$price,$stock)";

    validationEnd();
   
    run($sql);      
    return redirect(url("inventory"),"Item Created Successfully");
};

function delete() {
    $id = $_POST["id"];
    $sql = "DELETE FROM inventories WHERE id=$id";
    run($sql);
    return redirectBack("Item Deleted Successfully");   
};

function edit() {
    $id = $_GET["id"];
    $sql = "SELECT * FROM inventories WHERE id=$id";        
    return view("inventory/edit",["lists" => first($sql)]);  
};

function update(){    
    $id = $_POST["id"];    
    $name = $_POST["name"];    
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $sql = "UPDATE inventories SET name='$name',price=$price ,stock=$stock WHERE id=$id";    
    run($sql);
    return redirect(url("inventory"),"Item Updated Successfully");
};

