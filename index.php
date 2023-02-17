<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
require_once __DIR__.'/model/Database.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__.'/model/Entity.php';
require_once __DIR__.'/model/websitePanel.php';
ini_set('session.gc_maxlifetime', 259200);
session_set_cookie_params(259200);
session_start();

define('TABLE','data');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (file_exists(__DIR__ . "/controller/" . $page . ".php")) {
        require_once __DIR__ . "/controller/" . $page . ".php";
    } else {
        require_once __DIR__ . "/controller/404.php";
    }
} else {

    header("Location: https://drpciv.codeflow.ro/drpciv/index.php?page=dashboard");
}