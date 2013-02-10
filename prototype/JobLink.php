<?php
class JobLink extends PageLink{
	public $jobId;
	public function __construct($url, $id){
		$this->url = $url;
		$this->jobId = $id;
		$this->status = 0;
	}
	public function __toString(){
		return $this->jobId;
	}
}
?>