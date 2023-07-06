<?php

function index() {
    $sql = "SELECT * FROM  doubtMen";
    $query  = mysqli_query($GLOBALS["conn"],$sql);
    $lists = [];
    while($row = mysqli_fetch_assoc($query)){
        $lists[] = $row;
    }
    return view("list/index",["lists" => $lists]);
};

function create() {
    view("list/create");
}

function store() {    
    $name = $_POST["name"];
    $money = $_POST["money"];
    $sql = "INSERT INTO doubtMen (name,money) VALUES ('$name',$money)";
    $query = mysqli_query($GLOBALS["conn"],$sql);    
    redirect(url("list"));
}

function delete() {
    $id = $_GET["id"];
    $sql = "DELETE FROM doubtMen WHERE id=$id";
    $query = mysqli_query($GLOBALS["conn"],$sql);
    redirect(url("list"));    
}

function edit() {
    $id = $_GET["id"];
    $sql = "SELECT * FROM doubtMen WHERE id=$id";
    $query = mysqli_query($GLOBALS['conn'],$sql);
    $lists = mysqli_fetch_assoc($query);    
    return view("list/edit",["lists" => $lists]);  
}

function update(){    
    $id = $_POST["id"];    
    $name = $_POST["name"];    
    $money = $_POST["money"];
    $sql = "UPDATE doubtMen SET name='$name',money=$money WHERE id=$id";  
    
    $query = mysqli_query($GLOBALS["conn"],$sql);
    redirect(url("list"));
}

