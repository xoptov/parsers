<?php
error_reporting(E_ALL);
date_default_timezone_set("Europe/Moscow");

define('DEBUG_MODE', 0);
define('CONTROL_TABLE', 'parser_vacancies'); // Таблица записи и хранения контрольных значений для выявления дубликатов.
define('STORAGE_TABLE', 's_vacancies'); // Таблица записи и хранения вакансий.
define('CONFIG_TABLE', 's_confclassifer'); // Таблица конфигураций 1С.
define('VERSION_TABLE', 's_versclassifier'); // Таблица версий 1С.
define('PLACE_TABLE', 's_places'); // Таблица населенных пунктов.
define('COUNTRIES_TABLE', 's_countries'); // Таблица стран.

require_once("dbconfig.php");
require_once("prototype/Exceptions.php");
function __autoload($class){
	require_once("prototype/$class.php");
}
?>