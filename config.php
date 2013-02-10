<?php
error_reporting(E_ALL);
date_default_timezone_set("Europe/Moscow");
require_once("dbconfig.php");
function __autoload($class){
	require_once("prototype/$class.php");
}
?>