<?php
class JobFactoryV5 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_URL, $content, $match)){
			return "http://".SITE_DOMINE."/$match[1]-$match[2].html";
		}
	}
}
?>