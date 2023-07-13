<?php

function index() {
    $sql = "SELECT * FROM  doubtMen";
    if(!empty($_GET["q"])){
        $q= filterHTML($_GET["q"],true);
        $sql .= " WHERE name LIKE '%$q%'";
    }   
  
    return view("list/index",["lists" => paginate($sql,10)]);
};

function create() {
   return view("list/create");
}

function store() {
    unset($_SESSION["error"]); 
    unset($_SESSION["old"]);
    $_SESSION["old"] = $_POST;

     
    if(empty($_POST["name"])){
        setError("name","Name is required");
    }elseif(strlen($_POST["name"]) < 3){
        setError("name","Name Length must be gt than 3");
    }elseif(strlen($_POST["name"]) > 30){
        setError("name","Name Too Much long");
    }elseif(!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST["name"])){
        setError("name","Name must be character , numbers and space");
    }

    if(empty($_POST["money"])){
        setError("money","Money is required");
    }elseif(!preg_match("/^[0-9]*$/",$_POST["money"])){
        setError("money","Money must be Number");
    }
       
    if(hasSession("error")){
        redirectBack();
        die();
    }else{
    unset($_SESSION["old"]); 

    }

    


    $name = filterHTML($_POST["name"]);
    $money = $_POST["money"];
    $sql = "INSERT INTO doubtMen (name,money) VALUES ('$name',$money)";
    run($sql);      
    return redirect(url("list"),"Created Successfully");
}

function delete() {
    $id = $_POST["id"];
    $sql = "DELETE FROM doubtMen WHERE id=$id";
    run($sql);
    return redirect($_SERVER["HTTP_REFERER"],"Deleted Successfully");   
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
    return redirect(url("list"),"Updated Successfully");
}

