<?php

$uri = $_SERVER["REQUEST_URI"];
$uriArr = parse_url($uri);

$path = $uriArr["path"];

const routes = [
    "/" => "page@home",
    "/about-us" => "page@about",
    "/list" => "list@index",
    "/list-create" => "list@create",
    "/list-store" => ["post","list@store"],
    "/list-edit" => "list@edit",
    "/list-update" => ["put","list@update"],
    "/list-delete" => ["delete","list@delete"]    
];


if(array_key_exists($path,routes) && is_array(routes[$path]) && checkRequestMethod(routes[$path][0])){   
    controller(routes[$path][1]);
}elseif(array_key_exists($path,routes) && !is_array(routes[$path]) ){
    controller(routes[$path]);
}else{
    view("notfound");
}

