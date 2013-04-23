#!/usr/bin/php
<?php
require_once("../config.php");
define('SITE_DOMINE', 'www.rabota66.ru');
define('SITE_CHARSET', 'utf-8');
define('PAGELINK_REGEXP', '/href="\/vacancy\/search\?request=%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82\+1%D1%81&amp;pay_range_min=5000&amp;pay_range_max=80000&amp;page=([0-9]+)"/iu');
define('JOBLINK_REGEXP', '/href="\/vacancy\/([0-9]+)"/iu');
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
define('FA_JOB_ID', '/href="\/vacancy\/favorite\/([0-9]+)">добавьте\sее\sв\sизбранное/iu');
define('FA_DATE', '/<p\sclass="date\-">добавлена:\s([0-9\w\s]+)<\/p>/iu');
define('FA_TITLE', '/<h1\sclass="title\-">(.+)<\/h1>/isuU');
define('FA_DESCRIPTION', '/<div\sclass="details\-">\s*<div class="similar\-vac\-list">.*<\/ul>\s*<\/div>(.+)<b\sclass="button\-">/isuU');
define('FA_EMPLOY_TYPE', '/<dt>График<\/dt><dd>([\w\s]+)<\/dd>/iu');
define('FA_EXPERIENCE', '/<dt>Опыт<\/dt><dd>([0-9\w\s]+)<\/dd>/iu');
define('FA_PLACE', '/<b\sclass="address\-">([\w\s\-\.]+)<\/b>/iu');
define('FA_BUDGET', '/<b\sclass="salary\-">(?:от\s)?([0-9\s]+)(?:\s&ndash;\s<br\s\/>)?([0-9\s]+)\sруб\.<\/b>/iu');
define('FA_ORGANIZATION', '/Работодатель:<\/span><\/p>\s*<p><b><a\shref="\/vacancy\/bycompany[0-9]+">([0-9\w\"\'\-]+)<\/a>/iu');

$parser = new ParserV7("http://www.rabota66.ru/vacancy/search?request=%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82+1%D1%81&pay_range_min=5000&pay_range_max=80000");
$parser->start();
echo json_encode($parser->counter);
?>