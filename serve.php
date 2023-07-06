<?php

$port = rand(8000,9000);

if(strtoupper(substr(PHP_OS,0,3)) === "WIN"){
    system("cd public && php -S localhost:$port;"); 
}else{
    system("cd public;php -S localhost:$port;"); 
}