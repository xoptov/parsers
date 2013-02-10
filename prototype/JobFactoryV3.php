<?php
class JobFactoryV3 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://ekat.erabota.ru/job/search/?id=$match[1]#vacancy";
			return $url;
		}
	}
}
?>