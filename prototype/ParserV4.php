<?php
class ParserV4 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV4($dbh);
	}
	protected function parsePageLinks(&$content){}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$url = "http://".SITE_DOMINE."/vacancy/$match[1]?id=$match[2]";
				$this->addJobLink($url, $match[2]);
			}
		}
	}
}
?>