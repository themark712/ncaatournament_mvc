<?php
//define("ROOT_URL", "http://localhost:3000/");

$filepath = "";

if (strpos($_SERVER['REQUEST_URI'], "admin") > 0) {
    $filepath = "../";
}