<?php

require_once "../index.php";

// if ($_SERVER["REQUEST_URI"] === "/") {
//     require_once ViewDir . "/home.view.php";
// } elseif ($_SERVER["REQUEST_URI"] === "/about-us") {
//     require_once ViewDir . "/about.view.php";
// }

switch ($_SERVER["REQUEST_URI"]) {
    case "/":
        view("home",["myName" => "Kyaw","age" => 21]);
        break;

    case "/about-us":
        view("about");
        break;

    case "/list":
        controller("list@index");
        break;        

    // for unkown route
    default:
        view("notfound");;
}   
// dd($_SERVER);