<?php

$uri = $_SERVER["REQUEST_URI"];
$uriArr = parse_url($uri);

$path = $uriArr["path"];

const routes = [
    "/" => "page@home",
    "/about-us" => "page@about",
    "/show-session" => "page@ss",

    "/list" => "list@index",
    "/list-create" => "list@create",
    "/list-store" => ["post","list@store"],
    "/list-edit" => "list@edit",
    "/list-update" => ["put","list@update"],
    "/list-delete" => ["delete","list@delete"] ,
    
    "/inventory" => "inventory@index",
    "/inventory-create" => "inventory@create",
    "/inventory-store" => ["post","inventory@store"],
    "/inventory-edit" => "inventory@edit",
    "/inventory-update" => ["put","inventory@update"],
    "/inventory-delete" => ["delete","inventory@delete"],

    "/country" => "country@index",
    "/country-create" => "country@create",
    "/country-store" => ["post","country@store"],
    "/country-edit" => "country@edit",
    "/country-update" => ["put","country@update"],
    "/country-delete" => ["delete","country@delete"],

    "/api/families" => "family@index",
    "/api/family" => "family@show",    
    "/api/family-store" => ["post","family@store"],    
    "/api/family-update" => ["put","family@update"],
    "/api/family-delete" => ["delete","family@delete"],
    
    "/api/users" => "user@index",    
    "/api/user" => "user@show",    
    "/api/user-store" => ["post","user@store"],    
    "/api/user-update" => ["put","user@update"],
    "/api/user-delete" => ["delete","user@delete"],

    
];


if(array_key_exists($path,routes) && is_array(routes[$path]) && checkRequestMethod(routes[$path][0])){   
    controller(routes[$path][1]);
}elseif(array_key_exists($path,routes) && !is_array(routes[$path]) ){
    controller(routes[$path]);
}else{
    view("notfound");
}

