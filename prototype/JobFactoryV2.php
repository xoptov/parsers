<?php 
class JobFactoryV2 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://".SITE_DOMINE."/job/vacancy/$match[1].html";
			return $url;
		}
	}
}
?>