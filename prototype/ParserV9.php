<?php
class ParserV9 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV9($dbh);
	}
	protected function parsePageLinks(&$content){}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$url = "http://".SITE_DOMINE."/index.php/job/view/vacancy/$match[1]_$match[2]/";
				$this->addJobLink($url, $match[1]);
			}
		}
	}
}
?>