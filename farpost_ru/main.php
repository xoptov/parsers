<?php
require_once("../config.php");
define('SITE_DOMINE', 'vladivostok.farpost.ru');
define('SITE_CHARSET', 'cp1251');
define('JOBLINK_REGEXP', '/<a\sname="[0-9]+"\sclass="bulletinLink\s"\shref="http:\/\/vladivostok\.farpost\.ru\/([\w\-]+)\-([0-9]+)\.html"\s>[\w0-9\-\:\.\,\(\)\s]+<\/a>/iu');
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
define('FA_JOB_ID', '/<b\sid="bulletinId"\svalue="[0-9]+">№([0-9]+)<\/b>/iu');
define('FA_DATE', '/<span\stitle=\'[0-9\w\,\.\s]+\'>(.+)<\/span>/iuU');
define('FA_TITLE', '/<h1\sclass="subject">\s*([0-9\w\w\,\(\)\s]+?)\s*<span>/siu');
define('FA_DESCRIPTION', '/<div\sclass="fieldset\stext">(.+)<\/div>\s*<a\sname="userinfo">/siu');
define('FA_EMPLOY_TYPE', '/<div\sclass="label">Занятость<\/div>\s*<div\sclass="value">([\w\s]+)<\/div>\s*<\/div>/siuU');
define('FA_EXPERIENCE', '/<div\sclass="label">Опыт\sработы<\/div>\s*<div\sclass="value">([0-9\w\s\-]+)<\/div>/siu');
define('FA_PLACE', '/<nobr>\s*\(([\w\-\.]+)\)\s*<\/nobr>/siu');
define('FA_BUDGET', '/Оклад<\/div><div\sclass="value">(?:от)?\s?([0-9\s]+)\s(?:&ndash;\s)?([0-9\s]+)?р\./iu');
define('FA_ORGANIZATION', '/Предприятие<\/div>\s*<div\sclass="value">([0-9\w\s\"\'\-\.\,]+)<\/div>/isu');
define('FA_URL', '/href="\/bulletin\/[0-9]+\/bookmark\?origin=%2F([\w\-]+)-([0-9]+)\.html"/iu');

$parser = new ParserV5("http://vladivostok.farpost.ru/job/vacancy/1%D1+%CF%F0%EE%E3%F0%E0%EC%EC%E8%F1%F2/");
$parser->start();
echo json_encode($parser->counter);
?>