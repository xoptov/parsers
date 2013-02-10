<?php
class ParserV10 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV10($dbh);
	}
	protected function parsePageLinks(&$content){
		if(preg_match_all(PAGELINK_REGEXP, $content, $matches)){
			foreach($matches[1] as $match){
				$url = "http://".SITE_DOMINE."/job/vacancy/search/page-$match/?speciality=1%D1%81+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82";
				$this->addPageLink($url);
			}
		}
	}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$url = "http://".SITE_DOMINE."/job/vacancy/concrete-$match[1]/";
				$this->addJobLink($url, $match[1]);
			}
		}
	}
}
?>