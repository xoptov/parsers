<?php
require_once("../config.php");
define('SITE_DOMINE', 'nsk.erabota.ru');
define('SITE_CHARSET', 'cp1251');
define('PAGELINK_REGEXP', '/\shref="\?page=([0-9]+)"\stitle="Перейти\sна\sстраницу\s[0-9]+"/iuU');
define('JOBLINK_REGEXP', '/href="\?id=([0-9]+)(?:&page=[0-9]{1})?#vacancy"/iu');
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
define('FA_JOB_ID', '/Вакансия\s№([0-9]+)/iu');
define('FA_DATE', '/Вакансия\s№[0-9]+,\sоткрыта\s([0-9]{1,2}\s[\w]+\s\'[0-9]{2})/iuU');
define('FA_TITLE', '/<h1\sclass="last"><span\sclass="red">(.+)<\/span><\/h1>/iuU');
define('FA_DESCRIPTION', '/<td\sclass="left\sx-gray">Место<\/td>\s*<td>[\w\s\.\,\-]+<\/td>(.+)<div\sclass="gray-t-r">Требования\sк\sкандидату<\/div>/siuU');
define('FA_EMPLOY_TYPE', '/График&nbsp;работы<\/td>\s*<td>([\w\s]+)<\/td>/iu');
define('FA_EXPERIENCE', '/Стаж работы<\/td>\s*<td>([0-9\w\s]+)<\/td>/iu');
define('FA_PLACE', '/Место<\/td>\s*<td>([\w\s]+)(?:[\w\s\,]+)?<\/td>/iu');
define('FA_BUDGET', '/Зарплата<\/td>\s*<td><b\sclass="red">от\s(.+?)\sруб\.<\/b><\/td>/iuU');
define('FA_ORGANIZATION', '/компания<\/td><td>([\w\s\"\'\-]+)/iuU');

$parser = new ParserV3("http://nsk.erabota.ru/job/search/?search_keywords=1%F1+%EF%F0%EE%E3%F0%E0%EC%EC%E8%F1%F2&search_location=1&x=0&y=0#page_view");
$parser->start();
echo json_encode($parser->counter);
?>