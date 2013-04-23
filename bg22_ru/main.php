#!/usr/bin/php
<?php
require_once(dirname(__FILE__)."/../config.php");
define('SITE_DOMINE', 'bg22.ru');
define('SITE_CHARSET', 'cp1251');
define('FUTURE_URL_PREG', '/\/index\.php\?page=bank_vacancy&d=1%F1&hidka=1&sh=1&page1=[0-9]+/iu');
define('QUERY_OPTIONS_PREG', '/view_vac\(([0-9]+),([0-9]+),([0-9]+)\)/iu');
define('QUERY_TARGET_SCRIPT', 'http://bg22.ru/script/view_vacancy.php');
define('HTTP_GZIP', 1);

/* Константы для объявлений о ваканиях */
define('CUSTOMER_ID', 223);
define('IS_BUDGET_RANGE', 0);
define('BUDGET_HIGH', 0);
define('CURRENCY', 1);
define('RESTRICT_DISCUSSION', 0);
define('STATUS', 0);
define('COUNT_LANCER', 1);
define('USER_ID_COOKIE', 0);
define('IS_SHOW', 0);
define('FROM_PHONE', 0);
define('FIXEN_DATE', 0);
define('MONEY_ACT_SUM', 0);
define('CHANGE_DATE', 0);
define('COLOR_END_DATE', 0);
define('IS_SOCIAL_POST', 1);

/* Константы регулярных выражений для определение полей распознавания */
define('FA_JOB_ID', '/вакансия\s№([0-9]+)/iu');
define('FA_DATE', '/от\s([0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2})/iu');
define('FA_TITLE', '/<h2>([0-9\w\s\-\(\)\.\,\'\"]+)<\/h2>/iu');
define('FA_DESCRIPTION', '/<td\scolspan="2">Необходимые\sнавыки\sи\sопыт\sработы\:(.+)<\/td><\/tr>(?:<tr\sbgcolor="#ffffff"><td\scolspan="2">Дополнительно:(.+)<\/td>)?/siuU');
define('FA_EMPLOY_TYPE', '/График\sработы:&nbsp;<font\scolor="#3366CC"><b>([\w\s]+)<\/b><\/font>/iu');
define('FA_EXPERIENCE', '/Стаж\sработы:&nbsp;<font\scolor="#3366CC"><b>([0-9\w\s\-]+)<\/b>/iu');
define('FA_PLACE', '/<h3>([\w\-\s]+)<\/h3>/iu');
define('FA_BUDGET', '/ЗП\sот:&nbsp;<font\scolor="red"><b>([0-9]+)<\/b><\/font>/iu');
define('FA_ORGANIZATION', '/Организация:&nbsp;<font\scolor="#3366CC"><b>([\w\;\&\s\-\"\']+)<\/b><\/font><\/td>/iu');

$parser = new ParserV1("http://bg22.ru/?page=bank_vacancy&hidka=1&d=1%F1&sh=1");
$parser->start();
echo json_encode($parser->counter);
?>