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

function redirect(string $url,string $message=null):void{
    if(!is_null($message)){
        setSession($message);
    }
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

function checkRequestMethod(string $methodName):bool{
    $result = false;
    $methodName = strtoupper($methodName);
    $serverMethod = $_SERVER["REQUEST_METHOD"];
    if($methodName === "POST" && $serverMethod === "POST"){
        $result = true;
    }elseif($methodName === "PUT" && $serverMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"]) === "PUT"){
        $result = true;
    }elseif($methodName === "DELETE" && $serverMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"]) === "DELETE"){
        $result = true;
    }
    return $result;
}

function alert(string $message,string $color="success"):void
{
    echo "<div class='alert w-25 alert-$color'>$message</div>";
}

function paginator($lists)
{
    $links = "";
    foreach($lists['links'] as $link){
        $links .=  "<li class='page-item'><a class='page-link ". $link['is_active']."' href=' " .$link['url'] ."'>". $link['page_number'] ."</a></li>" ;
    };

    
    return "<div class=' d-flex justify-content-between'>
    <p>Total : ".$lists['total']." </p>
    <nav aria-label='Page navigation example'>
        <ul class='pagination'>
            
             ". $links . "             
            
        </ul>
    </nav>
</div>";
}

//more color reference => https://i.stack.imgur.com/HFSl1.png
function logger(string $message, int $colorCode = 32): void
{
    echo " \e[39m[LOG]" . " \e[{$colorCode}m" . $message . " \n";
}



//session function start

function setSession(string $message,string $key="message"):void
{
    $_SESSION[$key] = $message;
}

function hasSession(string $key= "message"):bool
{
    if(!empty($_SESSION[$key]))  return true;
    return false;
}

function showSession(string $key="message"):string
{
    $message =$_SESSION[$key];
    unset($_SESSION[$key]);
   return $message;
}

//database functions
function run(string $sql,bool $closeConnection = false):object|bool
{
    try {
        $query = mysqli_query($GLOBALS["conn"],$sql);
    $closeConnection && mysqli_close($GLOBALS["conn"]);
    return $query;
    } catch (Exception $e) {
        dd($e);
    }
}

function all(string $sql):array
{
    $query  = run($sql);
    $lists = [];
    while($row = mysqli_fetch_assoc($query)){
        $lists[] = $row;
    }
    return $lists;
}

function first(string $sql):array
{
    $query = run($sql);
    $lists = mysqli_fetch_assoc($query);
    return $lists;
}

function paginate(string $sql,int $limit = 10):array
{
    $total = first(str_replace("*","COUNT(id) AS total",$sql))["total"];   
   
    $pages = ceil($total/$limit);
    $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
    $offset = ($currentPage - 1)*10;
    $sql .= " Limit $offset,$limit";
    
    $links=[];

    for($i =1;$i<=$pages;$i++){
        $queries = $_GET;
        $queries["page"] = $i;
        $url = url().$GLOBALS["path"]."?".http_build_query($queries);
        $links[] = [
            "url" => $url,
            "is_active" => $currentPage == $i ? "active" : "",
            "page_number" => $i
        ];
    }

    $lists = [
        "total" => $total,
        "limit"=> $limit,
        "total_pages" => $pages,
        "current_page" => $currentPage,
        "data" => all($sql),
        "links" => $links
    ];
    return $lists;
}


