<?php

function url(string $path=null):string
{
    $url = $_SERVER['HTTPS'] ? "https" : "http";
    $url .= "://";
    $url .= $_SERVER["HTTP_HOST"];
    if(!is_null($path)){
        $url .= "/";
        $url .= $path;
    }
    return $url;
}

function route(string $path=null,array $queries = null):string
{
    $url = url($path);
    if(!is_null($queries)){
        $url .= "?".http_build_query($queries);
    }
    return $url;
}

function redirect(string $url):void{
    header("Location:".$url);
}

function dd($data,bool $type=false):void
{
    echo "<pre style=' margin:10px; padding:20px; background-color:#1d1d1d; color:#cdcdcd; border-radius:10px; line-height:1.5rem;'>";
    if($type){
        var_dump($data);
    }else{
        print_r($data);
    }
    echo "<pre/>";
    die();
}

function view(string $viewName,array $data=null) : void
{
    // array to variable
    if(!is_null($data)){
        foreach($data as $key => $value){
            //dynamic variable;
            ${$key} = $value;
        }
    }
       
    require_once ViewDir."/$viewName.view.php";
}

function controller(string $controllerName):void
{
    //string to array
    //list@index => ["list","index"];
    $controllerNameArr = explode("@",$controllerName);
    require_once ControllerDir."/$controllerNameArr[0].controller.php";

    //dynamic function call
    call_user_func($controllerNameArr[1]);
}
