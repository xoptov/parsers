<?php
class ParserV3 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV3($dbh);
	}
	protected function parsePageLinks(&$content){
		if(preg_match_all(PAGELINK_REGEXP, $content, $matches)){
			foreach($matches[1] as $match){
				$url = "http://".SITE_DOMINE."/job/search/?page=$match";
				$this->addPageLink($url);
			}
		}
	}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches)){
			foreach($matches[1] as $match){
				$url = "http://".SITE_DOMINE."/job/search/?id=$match#vacancy";
				$this->addJobLink($url, $match);
			}
		}
	}
}
?>