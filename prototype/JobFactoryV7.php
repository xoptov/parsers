<?php
class JobFactoryV7 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://www.rabota66.ru/vacancy/$match[1]";
			return $url;
		}
	}
}
?>