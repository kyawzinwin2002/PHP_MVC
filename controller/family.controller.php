<?php

function index() {
    $sql = "SELECT * FROM  familyMembers";
    if(!empty($_GET["q"])){
        $q= $_GET["q"];
        $sql .= " WHERE name LIKE '%$q%'";
    }   
  
    return responseJSON(paginate($sql,10));
};

function show(){
    $id = $_GET["id"];
    $sql = "SELECT * FROM familyMembers WHERE id = $id";
    return responseJSON(first($sql));
}


function store() {            
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $netWorth = $_POST["netWorth"];
    $address = $_POST["address"];
    $sql = "INSERT INTO familyMembers (name,gender,netWorth,address) VALUES ('$name','$gender',$netWorth,'$address')";
    run($sql); 
    
    $currentMember = first("SELECT * FROM familyMembers WHERE id={$GLOBALS["conn"]->insert_id}");
    return responseJSON($currentMember);    
}

function delete() {
    $id = $_GET["id"];
    $sql = "DELETE FROM familyMembers WHERE id=$id";
    run($sql);
    return responseJSON("Deleted Successfully");   
}

function update(){
    parse_str(file_get_contents("php://input"),$_PUT);    
    $id = $_GET["id"];    
    $name = $_PUT["name"];    
    $gender = $_PUT["gender"];
    $netWorth = $_PUT["netWorth"];
    $address = $_PUT["address"];
    $sql = "UPDATE familyMembers SET name='$name',gender='$gender', netWorth=$netWorth, address='$address' WHERE id=$id";    
    run($sql);
    return responseJSON("Updated Successfully");
}

