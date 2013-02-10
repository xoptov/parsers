<?php
class ParserV7 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV7($dbh);
	}
	protected function parsePageLinks(&$content){
		if(preg_match_all(PAGELINK_REGEXP, $content, $matches)){
			foreach($matches[1] as $match){
				$url = "http://".SITE_DOMINE."/vacancy/search/?request=%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82+1%D1%81&pay_range_min=5000&pay_range_max=80000&page=$match";
				$this->addPageLink($url);
			}
		}
	}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches)){
			foreach($matches[1] as $match){
				$url = "http://".SITE_DOMINE."/vacancy/$match";
				$this->addJobLink($url, $match);
			}
		}
	}
}
?>