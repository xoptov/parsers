<?php
class JobFactoryV6 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://www.".SITE_DOMINE."/inner.php?pathstring=search&urlparams=_avacancy_b$match[1]&result_id2=Array&profession=1с&category=25&city=-1&sex=-1&exp=0&age=&education=0&busy=0&pay=&vac_type1=2&datelimit=7&sortmode=byrelevance&pagecnt=60&printmode=short&currpage=0&search_mode=vacancy&action_mode=print&view_id=0";
			return $url;
		}
	}
}
?>