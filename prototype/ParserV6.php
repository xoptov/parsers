<?php
class ParserV6 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV6($dbh);
	}
	protected function parsePageLinks(&$content){}
	protected function parseJobLinks(&$content){
		if(preg_match_all(JOBLINK_REGEXP, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$this->addJobLink($match[0], $match[1]);
			}
		}
	}
}
?>