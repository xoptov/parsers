#!/usr/bin/php
<?php
require_once(dirname(__FILE__)."/../config.php");
define('SITE_DOMINE', '56.ru');
define('SITE_CHARSET', 'cp1251');
define('JOBLINK_REGEXP', '/http:\/\/56\.ru\/job\/vacancy\/([0-9]+)\.html/iu');
define('HTTP_GZIP', 1);

/* Константы для объявлений о ваканиях */
define('CUSTOMER_ID', 8249);
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
define('FA_JOB_ID', '/Просмотр\sданных\sпо\sвакансии\s([0-9]+)/iu');
define('FA_DATE', '/просмотров\s[0-9]+\sc\s([0-9]{1,2}&nbsp;[\w]+(?:\s[0-9]{4})?)/iu');
define('FA_TITLE', '/Должность<\/td>\s*<td>([0-9\w\s\-\:\'\"\(\)]+)/iu');
define('FA_DESCRIPTION', '/Условия<\/td>(.+)Образование/siuU');
define('FA_EMPLOY_TYPE', '/Тип\sработы<\/td>\s*<td>\s*([\w\s\-]+)/iu');
define('FA_EXPERIENCE', '/Стаж<\/td>\s*<td>([0-9\.\,\-\s]+)/iu');
define('FA_PLACE', '/Город<\/td>\s*<td>\s*([\w\s\-\.]+)/iu');
define('FA_BUDGET', '/Зарплата\,\sруб\.<\/td>\s*<td>\s*от\s([0-9\s]*[0-9])\s*(?:до\s([0-9\s]*[0-9]+))?/iu');
define('FA_ORGANIZATION', '/Фирма<\/td>\s*<td>\s*([\w\s\.\-\"\']+)/iu');

$parser = new ParserV2("http://56.ru/job/vacancy/1.php?Search=2&Country=0010010000000000000000&CityCode=00100101k0000010000000&Area=0&BranchID=7&Position=&Period=0&SalaryMin=&SalaryForm=0&WorkSchedule=0&Education=0&Sex=0&Stage=0&Query=1%F1");
$parser->start();
echo json_encode($parser->counter);
?>