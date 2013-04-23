#!/usr/bin/php
<?php
require_once("../config.php");
define('SITE_DOMINE', 'dp63.ru');
define('SITE_CHARSET', 'utf-8');
define('PAGELINK_REGEXP', '/<a\shref="http:\/\/dp63\.ru\/job\/vacancy\/search\/page-([0-9]+)\/\?speciality=1с\sпрограммист"/iu');
define('JOBLINK_REGEXP', '/<div\sclass="spec">R?<a\shref="http:\/\/dp63\.ru\/job\/vacancy\/concrete-([0-9]+)\/">/iu');
define('HTTP_GZIP', 1);

/* Константы для объявлений о ваканиях */
define('CUSTOMER_ID', 6666);
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
define('FA_JOB_ID', '/Вакансия\s№\s<b>([0-9]+)/iu');
define('FA_DATE', '/Опубликована\s<b>([0-9]{2}\.[0-9]{2}\.[0-9]{2})\s[0-9]{2}:[0-9]{2}<\/b>/iu');
define('FA_TITLE', '/<h1>([0-9\w\s\/\:\-\.\,\(\)\#\+]+)\s?<span/siuU');
define('FA_DESCRIPTION', '/<span\sclass="cg7">Опыт\sработы,\sнавыки,\sдолжностные\sобязанности:<\/span><\/td>\s*<td>(.+)<\/td>/siuU');
define('FA_EMPLOY_TYPE', '/<span\sclass="cg7">График\sработы:<\/span><\/td>\s*<td>([\w\s]+)<\/td>/siu');
define('FA_EXPERIENCE', '/<span\sclass="cg7">Опыт\sработы:<\/span><\/td>\s*<td>([0-9\w\s]+)<\/td>/siu');
define('FA_PLACE', '/<h2\sclass="llg">([\w\s\-]+).\sРабота<\/h2>/siu');
define('FA_BUDGET', '/<span\sid="vr">([0-9]+)<\/span>/iu');
define('FA_ORGANIZATION', '/<span\sid="org">([0-9\w\s\-]+)<\/span>/isu');

$parser = new ParserV10("http://dp63.ru/job/vacancy/search/?speciality=1%D1%81+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82&sphere=0&stuff=&age=&sex=0&education=0&experience=0&language=0&schedule=0&work_location=0");
$parser->start();
echo json_encode($parser->counter);
?>