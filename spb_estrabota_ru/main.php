#!/usr/bin/php
<?php
require_once(dirname(__FILE__)."/../config.php");
define('SITE_DOMINE', 'www.spb.estrabota.ru');
define('SITE_CHARSET', 'cp1251');
define('JOBLINK_REGEXP', '/<p\sclass="title"\sid="t[0-9]+"><a\shref="http:\/\/www\.spb\.estrabota\.ru\/index\.php\/job\/view\/vacancy\/([0-9]+)_([_0-9\w\:\-]+)\/">[0-9\w\-\s\:\,\.]+<\/a><\/p>/iu');
define('HTTP_GZIP', 1);

/* Константы для объявлений о ваканиях */
define('CUSTOMER_ID', 8241);
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
define('FA_JOB_ID', '/<a\shref="http:\/\/www\.spb\.estrabota\.ru\/index\.php\/job\/view\/vacancy\/([0-9]+)\/(?:\?printable=true)?">Распечатать<\/a>/iu');
define('FA_DATE', '/<span>([0-9]{2}\s[\w]+\s[0-9]{4})<\/span>/iu');
define('FA_TITLE', '/<h1>([0-9\w\:\-\s\(\)]+)<\/h1>/iuU');
define('FA_DESCRIPTION', '/<p class="desc">(.+?)<\/p>/siuU');
define('FA_EMPLOY_TYPE', '/<dt>График\sработы:<\/dt>\s*<dd>(.+)<\/dd>/siuU');
define('FA_EXPERIENCE', '/<dt>Опыт\sработы:<\/dt>\s*<dd>(.+)<\/dd>/siuU');
define('FA_PLACE', '/<p\sclass="city-date"\sid="cd[0-9]+">([\w\s\-]+)\s\|/siu');
define('FA_BUDGET', '/<p\sclass="pay">от\s([0-9]+)\s<span>руб.<\/span>/iu');
define('FA_ORGANIZATION', '/<dt>Работодатель:<\/dt>\s*<dd>([0-9\w\.\,\-\"\'\:\s]+)<\/dd>/iu');

$parser = new ParserV9("http://www.spb.estrabota.ru/index.php/job/resultadvanced/vacancy/?pArea=0&position=1%F1&city=14&age=&ageFrom=&ageTo=&educationS=0&experience=0&timetable=0&wSalary=&dateUpdate=1&advanced=%EF%EE%E8%F1%EA");
$parser->start();
echo json_encode($parser->counter);
?>