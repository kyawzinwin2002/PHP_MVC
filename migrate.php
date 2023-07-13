<?php

system("clear");
require_once "./core/connect.php";
require_once "./core/functions.php";

$tables = all("show tables");

foreach($tables as $table){
    run("DROP TABLE IF EXISTS ".$table["Tables_in_CRUD"]);
}

logger("All Tables are Deleted");

createTable("doubtMen","name varchar(100) not null","money int(11) not null");
createTable("inventories","name varchar(100) not null","price int(11) not null","stock int(11) not null");
createTable("users","name varchar(100) not null","email varchar(50) not null","gender enum('male','female') not null","address text not null");

createTable("countries","name varchar(20) not null","area int(11) not null");

createTable("familyMembers","name varchar(20) not null","gender enum('male','female') not null","netWorth int(11) not null","address text not null");


