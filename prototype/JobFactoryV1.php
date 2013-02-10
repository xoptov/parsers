<?php
class JobFactoryV1 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = QUERY_TARGET_SCRIPT."?dummy=".floor(microtime(1)*1000)."&idobj=$match[1]&iduser=0&rndm=435";
			return $url;
		}
	}
}
?>