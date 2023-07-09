<?php

function index() {
    $sql = "SELECT * FROM  doubtMen";
    if(!empty($_GET["q"])){
        $q= $_GET["q"];
        $sql .= " WHERE name LIKE '%$q%'";
    }
    
    // dd($lists);
    return view("list/index",["lists" => paginate($sql,10)]);
};

function create() {
    view("list/create");
}

function store() {    
    $name = $_POST["name"];
    $money = $_POST["money"];
    $sql = "INSERT INTO doubtMen (name,money) VALUES ('$name',$money)";
    run($sql);      
    redirect(url("list"),"Created Successfully");
}

function delete() {
    $id = $_POST["id"];
    $sql = "DELETE FROM doubtMen WHERE id=$id";
    run($sql);
    redirect($_SERVER["HTTP_REFERER"],"Deleted Successfully");   
}

function edit() {
    $id = $_GET["id"];
    $sql = "SELECT * FROM doubtMen WHERE id=$id";        
    return view("list/edit",["lists" => first($sql)]);  
}

function update(){    
    $id = $_POST["id"];    
    $name = $_POST["name"];    
    $money = $_POST["money"];
    $sql = "UPDATE doubtMen SET name='$name',money=$money WHERE id=$id";    
    run($sql);
    redirect(url("list"),"Updated Successfully");

}

