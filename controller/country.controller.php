<?php

function index() {
    $sql = "SELECT * FROM  countries";
    if(!empty($_GET["q"])){
        $q= $_GET["q"];
        $sql .= " WHERE name LIKE '%$q%'";
    }   
  
    return view("country/index",["lists" => paginate($sql,10)]);
};

function create() {
   return view("country/create");
}

function store() {        
    $name = $_POST["name"];
    $area = $_POST["area"];
    $sql = "INSERT INTO countries (name,area) VALUES ('$name',$area)";
    run($sql);      
    return redirect(url("country"),"Created Successfully");
}

function delete() {
    $id = $_POST["id"];
    $sql = "DELETE FROM countries WHERE id=$id";
    run($sql);
    return redirect($_SERVER["HTTP_REFERER"],"Deleted Successfully");   
}

function edit() {
    $id = $_GET["id"];
    $sql = "SELECT * FROM countries WHERE id=$id";        
    return view("country/edit",["lists" => first($sql)]);  
}

function update(){    
    $id = $_POST["id"];    
    $name = $_POST["name"];    
    $area = $_POST["area"];
    $sql = "UPDATE countries SET name='$name',area=$area WHERE id=$id";    
    run($sql);
    return redirect(url("country"),"Updated Successfully");
}

