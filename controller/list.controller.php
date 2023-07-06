<?php

function index() {
    $sql = "SELECT * FROM  doubtMen";
    $query  = mysqli_query($GLOBALS["conn"],$sql);
    $lists = [];
    while($row = mysqli_fetch_assoc($query)){
        $lists[] = $row;
    }
    return view("list/index",["lists" => $lists]);
}
