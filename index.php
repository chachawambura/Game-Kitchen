<?php
session_start();

require_once "includes/configs.php";
require_once "includes/en.php";

if (isset($_SESSION['myid']))
    echo baseModel::session_checker($_SESSION['login']);

if ($_REQUEST['url'] == 'logout') {
    echo defaultModel::logout();
}  else {
    //do nothing
}

$include = ( isset($_SESSION['myid']) ) ? 'default' : 'guest';



include _DEFAULT . DS . $include . EXT;
?>
