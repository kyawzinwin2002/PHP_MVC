<?php

function home()
{
    view("home", ["myName" => "Kyaw", "age" => 21]);
};

function about()
{
    view("about", ["myName" => "Kyaw", "age" => 21]);
};


