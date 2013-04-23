#!/usr/bin/php
<?php
require_once("../config.php");
define('SITE_DOMINE', 'job.professia.info');
define('SITE_CHARSET', 'utf-8');
define('PAGELINK_REGEXP', '/href="\?i33lt=1%D1%81+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82&amp;i33lp%5B0%5D=0&amp;i33lp%5B3%5D=3&amp;i33li=1&amp;i33lr=0&amp;i33ln=&amp;i33lx=&amp;i33le=&amp;i33ll=([0-9]+)/iuU');
define('JOBLINK_REGEXP', '/href="\/vacview\/\?i34lvac_id=([0-9]+)"/iu');
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
define('FA_JOB_ID', '/<a\starget="_blank"\shref="\/vacfile\/\?i38lvac_id=([0-9]+)\s?"\s?>\sСохранить\sв\sфайл\s<\/a>/iu');
define('FA_DATE', '/Опубликовано:\s([0-9]{2}\s[\w]+\s[0-9]{4})/iu');
define('FA_TITLE', '/<p\sclass="bldv_title stvacv_title"\s?>([0-9\w\-\s\(\)\.\,\#\+]+)<\/p>/iuU');
define('FA_DESCRIPTION', '/<td\sclass="bldv_mk_tdd\sstvacv_wage_tdd"\s?>(.+)Контакты\s<\/td>/siuU');
define('FA_EMPLOY_TYPE', '/>График\sработы:\s(.+)<br\s\/>/iuU');
define('FA_EXPERIENCE', '/опыт\sработы\s?<\/span>(.+)<\/td>/iuU');
define('FA_PLACE', '/Город\s?<\/span>([а-я\-\.\,]+)<\/td>/siu');
define('FA_BUDGET', '/<td\sclass="bldv_mk_tdd\sstvacv_wage_tdd"\s?>\s?(?:от\s([0-9]+))?\s?(?:до\s([0-9]+))?\sруб\.\s<\/td>/iuU');
define('FA_ORGANIZATION', '/<td\sclass="bldv_mk_tdd stvacv_fio_tdd"\s?>([\w\s]+)<\/td>/iuU');

$parser = new ParserV8("http://job.professia.info/vaclistview/?i33lt=1%D1%81+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82&i33lp%5B0%5D=0&i33lp%5B3%5D=3&i33li=1&i33lr=0&i33ln=&i33lx=&i33le=&i33ll=0");
$parser->start();
echo json_encode($parser->counter);
?>