<?php
final class JobFactoryV9 extends JobFactory{
	protected function getUrl(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)){
			$url = "http://".SITE_DOMINE."/index.php/job/view/vacancy/$match[1]/";
			return $url;
		}
	}
}
?>