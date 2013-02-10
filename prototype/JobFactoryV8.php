<?php
class JobFactoryV8 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://".SITE_DOMINE."/vacview/?i34lvac_id=$match[1]";
			return $url;
		}
	}
}
?>