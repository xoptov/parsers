<?php
abstract class Parser{
	protected $ch;
	protected $dbh;
	protected $jobFactory;
	protected $pageLinks = array();
	protected $jobLinks = array();
	protected $jobs = array();
	public $counter;
	public function __construct($startPoint){
		try{
			$this->initCh();
			$this->dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
			$this->dbh->query("SET CHARACTER SET utf8");
			$this->jobFactory = $this->createFactory($this->dbh);
			$this->counter = new Counter();
			$this->addPageLink($startPoint);
		}catch(ErrorException $e){
			header("Internal Server Error", true, 500);
			echo $e->getMessage();
			exit(1);
		}
	}
	abstract protected function createFactory($dbh);
	abstract protected function parsePageLinks(&$content);
	abstract protected function parseJobLinks(&$content);
	protected function addPageLink($url){
		if($this->pageLinks){
			foreach($this->pageLinks as $pageLink){
				if($this->checkPageLinkDuplicate($url)) array_push($this->pageLinks, new PageLink($url));
			}
		}else{
			array_push($this->pageLinks, new PageLink($url));
		}
	}
	protected function addJobLink($url, $jobId){
		try{
			$this->checkJobLinkDuplicate($jobId);
			array_push($this->jobLinks, new JobLink($url, $jobId));
		}catch(DuplicateException $e){}
	}
	protected function checkPageLinkDuplicate($url){
		foreach($this->pageLinks as $pageLink){
			if($pageLink==$url) return false;
		}
		return true;
	}
	public function start(){
		$this->prePassage();
		$this->mainPassage();
		$this->saveJobs();
	}
	protected function prePassage(){
		while($pageLink = $this->getUnvisitedPageLink()){
			try{
				$content = $this->getContent($pageLink);
				$this->counter->completedJobListPage++;
				$this->parsePageLinks($content);
				$this->parseJobLinks($content);
				unset($content);
			}catch(ContentException $e){
				$this->counter->referralErrors++;
			}
		}		
	}
	protected function mainPassage(){
		while($jobLink = $this->getUnvisitedJobLink()){
			try{
				$this->checkJobDuplicate($jobLink);
				$content = $this->getContent($jobLink);
				$this->counter->completedJobPage++;
				$job = $this->jobFactory->createJobFromRaw($content);
				array_unshift($this->jobs, $job);
			}catch(DuplicateException $e){
				$this->counter->foundDuplicateJobs++;
			}catch(ContentException $e){
				$this->counter->referralErrors++;
			}catch(PoorExpression $e){
				$this->counter->poorExtressions++;
				if(DEBUG_MODE&1) echo $e->getMessage();
			}
		}
	}
	protected function saveJobs(){
		if($this->jobs){
			foreach($this->jobs as $job){
				try{
					$job->save($this->dbh);
					$this->counter->savedJobs++;
				}catch(WritingException $e){
					$this->counter->errorWritingDatabase++;
				}catch(PoorQualityException $e){
					$this->counter->poorQualityJobs++;
				}
			}
		}
	}
	protected function checkJobDuplicate($object){
		$sql = sprintf("SELECT id FROM ".CONTROL_TABLE." WHERE domine = '%s' AND real_id = %s LIMIT 1", SITE_DOMINE, $object);
		$sth = $this->dbh->query($sql);
		if($sth->fetchColumn()){
			$object->status = 3;
			throw new DuplicateException();
		}
	}
	protected function getContent($linkObject){
		curl_setopt($this->ch, CURLOPT_URL, $linkObject->url);
		if($content = curl_exec($this->ch)){
			$linkObject->status = 1;
			$this->convSite2DbCharset($content);
			return $content;
		}else{
			$linkObject->status = 2;
			throw new ContentException();
		}
	}
	protected function convSite2DbCharset(&$content){
		if(SITE_CHARSET!="utf-8") $content = iconv(SITE_CHARSET, "utf-8", $content);
	}
	protected function checkJobLinkDuplicate($jobId){
		if($this->jobLinks){
			foreach($this->jobLinks as $jobLink){
				if($jobLink==$jobId) throw new DuplicateException();
			}
		}
		return true;
	}
	protected function initCh(){
		if($this->ch = curl_init()){
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, "../cookie.db");
			if(HTTP_GZIP) curl_setopt($this->ch, CURLOPT_ENCODING, "gzip");
			if(DEBUG_MODE&1) curl_setopt($this->ch, CURLOPT_NOPROGRESS, 0);
			if(DEBUG_MODE&2) curl_setopt($this->ch, CURLOPT_PROXY, "127.0.0.1:8888");
			if(DEBUG_MODE&4) curl_setopt($this->ch, CURLOPT_VERBOSE, 1);
		}else{
			throw new ErrorException("Ошибка иницилизации cURL!\n");
		}
	}
	public function __destruct(){
		curl_close($this->ch);
	}
	protected function getUnvisitedPageLink(){
		if($this->pageLinks){
			foreach($this->pageLinks as $pageLink){
				if($pageLink->status==0) return $pageLink;
			}
		}
	}
	protected function getUnvisitedJobLink(){
		if($this->jobLinks){
			foreach($this->jobLinks as $jobLink){
				if($jobLink->status==0) return $jobLink;
			}
		}
	}
}
?>