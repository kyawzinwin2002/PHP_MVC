<?php

function url(string $path = null): string
{
    $url = $_SERVER['HTTPS'] ? "https" : "http";
    $url .= "://";
    $url .= $_SERVER["HTTP_HOST"];
    if (!is_null($path)) {
        $url .= "/";
        $url .= $path;
    }
    return $url;
}

function route(string $path = null, array $queries = null): string
{
    $url = url($path);
    if (!is_null($queries)) {
        $url .= "?" . http_build_query($queries);
    }
    return $url;
}

function redirect(string $url, string $message = null): void
{
    if (!is_null($message)) {
        setSession($message);
    }
    header("Location:" . $url);
}

function redirectBack(string $message = null): void
{
    redirect($_SERVER["HTTP_REFERER"], $message);
}

function dd($data, bool $type = false): void
{
    echo "<pre style=' margin:10px; padding:20px; background-color:#1d1d1d; color:#cdcdcd; border-radius:10px; line-height:1.5rem;'>";
    if ($type) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo "<pre/>";
    die();
}

function view(string $viewName, array $data = null): void
{
    // array to variable
    if (!is_null($data)) {
        foreach ($data as $key => $value) {
            //dynamic variable;
            ${$key} = $value;
        }
    }

    require_once ViewDir . "/$viewName.view.php";
}

function controller(string $controllerName): void
{
    //string to array
    //list@index => ["list","index"];
    $controllerNameArr = explode("@", $controllerName);
    require_once ControllerDir . "/$controllerNameArr[0].controller.php";

    //dynamic function call
    call_user_func($controllerNameArr[1]);
}

function checkRequestMethod(string $methodName): bool
{
    $result = false;
    $methodName = strtoupper($methodName);
    $serverMethod = $_SERVER["REQUEST_METHOD"];
    if ($methodName === "POST" && $serverMethod === "POST") {
        $result = true;
    } elseif ($methodName === "PUT" && ($serverMethod === "PUT" ||  ($serverMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"]) === "PUT"))) {
        $result = true;
    } elseif ($methodName === "DELETE" && ($serverMethod = "DELETE" || ($serverMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"]) === "DELETE"))) {
        $result = true;
    }
    return $result;
}

function alert(string $message, string $color = "success"): void
{
    echo "<div class='alert w-25 alert-$color'>$message</div>";
}

function paginator($lists)
{
    $links = "";
    foreach ($lists['links'] as $link) {
        $links .=  "<li class='page-item'><a class='page-link " . $link['is_active'] . "' href=' " . $link['url'] . "'>" . $link['page_number'] . "</a></li>";
    };


    return "<div class=' d-flex justify-content-between'>
    <p>Total : " . $lists['total'] . " </p>
    <nav aria-label='Page navigation example'>
        <ul class='pagination'>
            
             " . $links . "             
            
        </ul>
    </nav>
</div>";
}

//more color reference => https://i.stack.imgur.com/HFSl1.png
function logger(string $message, int $colorCode = 32): void
{
    echo " \e[39m[LOG]" . " \e[{$colorCode}m" . $message . " \n";
}


function responseJSON(mixed $data, int $status = 200): string
{
    header("Content-type:Application/json");
    http_response_code($status);
    if (is_array($data)) {
        return print(json_encode($data));
    }
    return print(json_encode(["message" => $data]));
}

function filterHTML($str, bool $strip = false): string
{
    // $str = str_replace("script","",$str);
    // $str = trim($str,"<></>");
    if ($strip) {
        $str = strip_tags($str);
    }
    $str = trim($str);
    $str = htmlentities($str, ENT_QUOTES);
    $str = stripslashes($str);
    return $str;
}

//validation function start
function setError(string $key, string $message): void
{
    $_SESSION["error"][$key] = $message;
}

function hasError(string $key): bool
{
    if (!empty($_SESSION["error"][$key]))  return true;
    return false;
}

function showError(string $key): string
{
    $message = $_SESSION["error"][$key];
    unset($_SESSION["error"][$key]);
    return $message;
}

function old(string $key): string | null
{
    if (isset($_SESSION["old"][$key])) {
        $data = $_SESSION["old"][$key];
        unset($_SESSION["old"][$key]);
        return $data;
    }
    return null;
}



function validationStart(): void
{
    unset($_SESSION["old"]);
    unset($_SESSION["error"]);
    $_SESSION["old"] = $_POST;
}

function validationEnd(bool $isAPI = false): void
{
    if (hasSession("error")) {
        if ($isAPI) {
            responseJSON([
                "status" => false,
                "errors" => showSession("error")
            ]);
        } else {
            redirectBack();
        }
        die();
    } else {
        unset($_SESSION["old"]);
    }
}


//session function start
function setSession(string $message, string $key = "message"): void
{
    $_SESSION[$key] = $message;
}

function hasSession(string $key = "message"): bool
{
    if (!empty($_SESSION[$key]))  return true;
    return false;
}

function showSession(string $key = "message"): string | array
{
    $message = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $message;
}

//database functions
function run(string $sql, bool $closeConnection = false): object|bool
{
    try {
        $query = mysqli_query($GLOBALS["conn"], $sql);
        $closeConnection && mysqli_close($GLOBALS["conn"]);
        return $query;
    } catch (Exception $e) {
        dd($e);
    }
}

function all(string $sql): array
{
    $query  = run($sql);
    $lists = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $lists[] = $row;
    }
    return $lists;
}

function first(string $sql): array
{
    $query = run($sql);
    $lists = mysqli_fetch_assoc($query);
    return $lists;
}

function paginate(string $sql, int $limit = 10): array
{
    $total = first(str_replace("*", "COUNT(id) AS total", $sql))["total"];
    $pages = ceil($total / $limit);
    $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
    $offset = ($currentPage - 1) * 10;

    $sql .= " Limit $offset,$limit";

    $links = [];

    for ($i = 1; $i <= $pages; $i++) {
        $queries = $_GET;
        $queries["page"] = $i;
        $url = url() . $GLOBALS["path"] . "?" . http_build_query($queries);
        $links[] = [
            "url" => $url,
            "is_active" => $currentPage == $i ? "active" : "",
            "page_number" => $i
        ];
    }

    $lists = [
        "total" => $total,
        "limit" => $limit,
        "total_pages" => $pages,
        "current_page" => $currentPage,
        "data" => all($sql),
        "links" => $links
    ];
    return $lists;
}

function createTable(string $tableName, ...$columns)
{

    $sql = "DROP TABLE IF EXISTS `$tableName`";
    run($sql);
    logger("Delete Table Successfully", 93);

    $sql = "CREATE TABLE `$tableName` (
    `id` int NOT NULL AUTO_INCREMENT,
    " . join(",", $columns) . ",
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,    
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci";

    run($sql);
    logger("Create " . $tableName . " Successfully");
}
