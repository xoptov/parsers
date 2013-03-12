<?php
error_reporting(E_ALL);
date_default_timezone_set("Europe/Moscow");

define('DEBUG_MODE', 0);
define('CONTROL_TABLE', 'parser_vacancies'); // ������� ������ � �������� ����������� �������� ��� ��������� ����������.
define('STORAGE_TABLE', 's_vacancies'); // ������� ������ � �������� ��������.
define('CONFIG_TABLE', 's_confclassifer'); // ������� ������������ 1�.
define('VERSION_TABLE', 's_versclassifier'); // ������� ������ 1�.
define('PLACE_TABLE', 's_places'); // ������� ���������� �������.
define('COUNTRIES_TABLE', 's_countries'); // ������� �����.

require_once("dbconfig.php");
require_once("prototype/Exceptions.php");
function __autoload($class){
	require_once("prototype/$class.php");
}
?>