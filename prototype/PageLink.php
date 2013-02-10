<?php
class PageLink{
	public $url;
	public $status;
	public function __construct($url){
		$this->url = $url;
		$this->status = 0;
	}
	public function __toString(){
		return $this->url;
	}
}
?>