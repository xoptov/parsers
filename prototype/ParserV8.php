<?php
class ParserV8 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV8($dbh);
	}
	protected function parsePageLinks(&$content){
		if(preg_match_all(PAGELINK_REGEXP, $content, $matches)){
			foreach($matches[1] as $match){
				$url = "http://".SITE_DOMINE."/vaclistview/?i33lt=1%D1%81+%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%81%D1%82&amp;i33lp%5B0%5D=0&amp;i33lp%5B3%5D=3&amp;i33li=1&amp;i33lr=0&amp;i33ln=&amp;i33lx=&amp;i33le=&amp;i33ll=$match";
				$this->addPageLink($url);
			}
		}
	}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$url = "http://".SITE_DOMINE."/vacview/?i34lvac_id=$match[1]";
				$this->addJobLink($url, $match[1]);
			}
		}
	}
}
?>