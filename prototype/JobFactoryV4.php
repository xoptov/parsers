<?php
class JobFactoryV4 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_URL, $content, $match)){
			$url = "http://".SITE_DOMINE."/vacancy/$match[1]/?id=$match[2]";
			return $url;
		}
	}
}
?>