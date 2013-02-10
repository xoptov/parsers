<?php
class JobFactoryV10 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://".SITE_DOMINE."/job/vacancy/concrete-$match[1]/";
			return $url;
		}
	}
}
?>