<?php
require_once("../config.php");
define('SITE_DOMINE', 'rabota.ngs.ru');
define('SITE_CHARSET', 'utf-8');
define('JOBLINK_REGEXP', '/href="\/vacancy\/([_0-9\w]+)\?id=([0-9]+)"/iu');
define('HTTP_GZIP', 1);
define('DEBUG_MODE', 3);

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
define('FA_JOB_ID', '/вакансия\s№\s([0-9]+)/iu');
define('FA_DATE', '/обновлена\s([0-9]{2}\.[0-9]{2}\.[0-9]{4})/iu');
define('FA_TITLE', '/<h3\stitle=".+">([_0-9\w\(\)\-\s\,\.]+)<\/h3>/iuU');
define('FA_DESCRIPTION', '/<td\sid="vac-desc-val">(.+)<h4>Требования\sк\sкандидату<\/h4>/siuU');
define('FA_EMPLOY_TYPE', '/<td\sid="vac-working_type-val">\s*([\w\s\-\.]+?)\s*<\/td>/siu');
define('FA_EXPERIENCE', '/<td\sid="vac-experience_length-val">\s*([0-9\w\s\-]+)\s*<\/td>/siuU');
define('FA_PLACE', '/<div\sclass="address">\s*([\w\-\.]+),/siu');
define('FA_BUDGET', '/class="pay">(?:от\s([0-9\s]+))?(?:&nbsp;)?(?:до\s([0-9\s]+))?\sруб\./iuU');
define('FA_ORGANIZATION', '/<td\sid="vac-company-val">(.+)<span/iuU');
define('FA_URL', '/href="\/vacancy\/([_0-9\w]+)\?id=([0-9]+)&format=doc"\sclass="file-word-link"/iu');

$parser = new ParserV4("http://rabota.ngs.ru/vacancy?&search_key=eqngfrw&order_by[]=orderby_date&order_dir[]=desc&limit=100");
$parser->start();
echo json_encode($parser->counter);
?>