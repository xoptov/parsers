<?php
require_once("../config.php");
define('SITE_DOMINE', 'rabotagrad.ru');
define('SITE_CHARSET', 'cp1251');
define('JOBLINK_REGEXP', '/http:\/\/www\.rabotagrad\.ru\/inner\.php\?pathstring=search&urlparams=_avacancy_b([0-9]+)&result_id2=Array&profession=1с&category=25&city=-1&sex=-1&exp=0&age=&education=0&busy=0&pay=&vac_type1=2&datelimit=7&sortmode=byrelevance&pagecnt=60&printmode=short&currpage=0&search_mode=vacancy&action_mode=print&view_id=0/iu');
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
define('FA_JOB_ID', '/<a\shref="http\:\/\/www\.rabotagrad\.ru\/mypage\/vacsel\/_aadd_b([0-9]+)"\s?>Добавить\sв\sизбранное<\/a>/iu');
define('FA_DATE', '/<div\sclass="date">Вакансия\sразмещена:\s(.+)<\/div>/iuU');
define('FA_TITLE', '/<h1>(.+)<\/h1>/iuU');
define('FA_DESCRIPTION', '/<div\sclass="text">(.+)<\/div>/siuU');
define('FA_EMPLOY_TYPE', '/<tr>\s*<th>Занятость:<\/th>\s*<td>([а-я\.]+)<\/td>/iu');
define('FA_EXPERIENCE', '/<tr>\s*<th>Опыт\sработы:<\/th>\s*<td>(ю+)<\/td>/iuU');
define('FA_PLACE', '/<tr>\s*<th>Город:<\/th>\s*<td>([\w\s\.\,\-]+)<\/td>/iu');
define('FA_BUDGET', '/<div\sclass="zp">Заработная\sплата:&nbsp;<span>\n\s*([0-9\s]+)\sруб\.<\/span>/iu');
define('FA_ORGANIZATION', '/<div\sclass="companyInfo">\n\s*<h3>(.+)<\/h3>/iuU');

$parser = new ParserV6("http://www.rabotagrad.ru/search/_avacancy?profession=1%F1&category=25&city=-1&sex=-1&exp=0&age=&education=0&busy=0&pay=&vac_type1=2&datelimit=7&sortmode=byrelevance&pagecnt=60&printmode=short&currpage=0&search_mode=vacancy&action_mode=print&view_id=0&result_id2%5B%5D=629249&result_id2%5B%5D=632250&result_id2%5B%5D=632239&result_id2%5B%5D=629864&result_id2%5B%5D=630017&result_id2%5B%5D=632244&result_id2%5B%5D=630004&result_id2%5B%5D=628443&result_id2%5B%5D=631541&result_id2%5B%5D=632275&result_id2%5B%5D=630742&result_id2%5B%5D=630761&result_id2%5B%5D=632241&result_id2%5B%5D=632948&result_id2%5B%5D=632951&result_id2%5B%5D=628422&result_id2%5B%5D=632947&result_id2%5B%5D=632243&result_id2%5B%5D=632273&result_id2%5B%5D=632257&result_id2%5B%5D=632249&result_id2%5B%5D=632246&result_id2%5B%5D=628429&result_id2%5B%5D=632269&result_id2%5B%5D=628430&result_id2%5B%5D=629884&result_id2%5B%5D=630746&result_id2%5B%5D=628445&result_id2%5B%5D=557953&result_id2%5B%5D=631264");
$parser->start();
echo json_encode($parser->counter);
?>