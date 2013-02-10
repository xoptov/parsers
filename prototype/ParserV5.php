<?php
class ParserV5 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV5($dbh);
	}
	protected function parsePageLinks(&$content){}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$url = "http://".SITE_DOMINE."/$match[1]-$match[2].html";
				$this->addJobLink($url, $match[2]);
			}
		}
	}
}
?>