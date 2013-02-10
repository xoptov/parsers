<?php
class ParserV1 extends Parser{
	protected function createFactory($dbh){
		return new JobFactoryV1($dbh);
	}
	protected function parsePageLinks(&$content){
		if(preg_match_all(FUTURE_URL_PREG, $content, $matches)){
			foreach($matches[0] as $match){
				$this->addPageLink("http://".SITE_DOMINE.$match);
			}
		}
	}
	protected function parseJobLinks(&$content){
		if(preg_match_all(QUERY_OPTIONS_PREG, $content, $matches, PREG_SET_ORDER)){
			foreach($matches as $match){
				$url = QUERY_TARGET_SCRIPT."?dummy=".floor(microtime(1)*1000)."&idobj=$match[1]&iduser=$match[2]&rndm=$match[3]";
				$this->addJobLink($url, $match[1]);
			}
		}
	}
}
?>