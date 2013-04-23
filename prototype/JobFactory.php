<?php 
abstract class JobFactory{
	protected $dbh;
	protected $listCP = array();
	protected $listCAV = array();
	public function __construct($dbh){
		try{
			$this->dbh = $dbh;
			$this->loadCP();
			$this->loadCAV();
		}catch(ErrorException $e){
			echo $e->getMessage();
		}
	}
	abstract protected function getUrl(&$content);
	protected function loadCAV(){
		$sth = $this->dbh->query("SELECT cc.id, cc.name, vc.id AS version_id, vc.name AS version_name FROM ".CONFIG_TABLE." AS cc INNER JOIN ".VERSION_TABLE." AS vc ON cc.vers_id = vc.id ORDER BY version_name");
		if($sth->fetchColumn()){
			while($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($this->listCAV, new ItemCAV($row->id, $row->name, $row->version_id, $row->version_name));
			}
		}else{
			throw new ErrorException("Ошибка загрузки записей \"Конфигураций и Версий\" из БД!\n");
		}
	}
	protected function loadCP(){
		$sth = $this->dbh->query("SELECT p.id AS p_id, p.descr AS p_name, c.id AS c_id, c.descr AS c_name FROM ".PLACE_TABLE." AS p INNER JOIN ".COUNTRIES_TABLE." AS c ON p.countryid = c.id");
		if($sth->fetchColumn()){
			while($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($this->listCP, new ItemCP($row->p_id, $row->p_name, $row->c_id, $row->c_name));
			}
		}else{
			throw new ErrorException("Ошибка загрузки записей \"Стран и Городов\" из БД!\n");
		}
	}
	public function createJobFromRaw(&$content){
		$job = new Job();
		$job->id = $this->getId($content);
		$job->date = $this->getDate($content);
		$this->setTitle($job, $content);
		$this->setDescription($job, $content);
		$job->employType = $this->getEmployType($content);
		$job->experience = $this->getExperience($content);
		$this->setCAV($job, $content);
		$job->customerId = CUSTOMER_ID;
		$this->setCP($job, $content);
		$this->setBudget($job, $content);
		$job->currency = CURRENCY;
		$job->status = STATUS;
		$job->restrictDiscussion = RESTRICT_DISCUSSION;
		$job->url = $this->getUrl($content);
		$job->countLancer = COUNT_LANCER;
		$job->organization = $this->getOrganization($content);
		$job->userIdCookie = USER_ID_COOKIE;
		$job->isShow = IS_SHOW;
		$job->fromPhone = FROM_PHONE;
		$job->fixenDate = FIXEN_DATE;
		$job->moneyActSum = MONEY_ACT_SUM;
		$job->changeDate = CHANGE_DATE;
		$job->colorEndDate = COLOR_END_DATE;
		$job->isSocialPost = IS_SOCIAL_POST;
		return $job;
	}
	protected function getId(&$content){
		if(preg_match(FA_JOB_ID, $content, $match)) return $match[1];
	}
	protected function getDate(&$content){
	    return date('Y-m-d H:i:s');
	}
	protected function setTitle($job, &$content){
		if(preg_match(FA_TITLE, $content, $match)){
			$job->title = trim(strip_tags($match[1]));
		}else{
			throw new PoorExpression("Не удачное регулярное выражение для поля title [id:{$job->id}]\n");
		}
	}
	protected function setDescription($job, &$content){
		if(preg_match(FA_DESCRIPTION, $content, $match)){
			$job->description = trim(strip_tags(preg_replace("/[\t\r\n]/"," ",$match[1]),"<br><ul><li><p><h2><h3>"));
		}else{
			throw new PoorExpression("Не удачное регулярное выражение для поля description [id:{$job->id}]\n");
		}
		
	}
	protected function getEmployType(&$content){
		if(preg_match(FA_EMPLOY_TYPE, $content, $match)){
			if(preg_match('/полный|постоян|полная|дневная/iu', $match[1])) return 0;
			if(preg_match('/удален|любая|частич/iu', $match[1])) return 1;
			if(preg_match('/неполн|свободн/iu', $match[1])) return 2;
		}
	}
	protected function getExperience(&$content){
		if(preg_match(FA_EXPERIENCE, $content, $match)) return trim($match[1]);
	}
	protected function getPlace(&$content){
		if(preg_match(FA_PLACE, $content, $match)){
			$sql = "SELECT id FROM ".PLACE_TABLE." WHERE descr LIKE '%$match[1]%'";
			$sth = $dbh->query($sql);
			if($sth->fetchColumn()){
				$row = $sth->fetch(PDO::FETCH_OBJ);
				return $row->id;
			}
		}
	}
	protected function setBudget($job, &$content){
		$expr = array('/\s/u','/&nbsp;/u');
		$replace = array('','');
		if(preg_match(FA_BUDGET, $content, $match)){
			if(isset($match[1])) $job->budgetLow = preg_replace($expr, $replace, $match[1]);
			if(isset($match[2])) $job->budgetHigh = preg_replace($expr, $replace, $match[2]);
		}
		if($job->budgetLow&&$job->budgetHigh){
			$job->isBudgetRange = 1;
		}else{
			$job->isBudgetRange = IS_BUDGET_RANGE;
		}
	}
	protected function getOrganization(&$content){
		if(preg_match(FA_ORGANIZATION, $content, $match)) return trim(strip_tags($match[1]));
	}
	protected function setCAV($job, &$content){
		if($this->listCAV){
			foreach($this->listCAV as $item){
				$configNameExpr = array('/[02-9]/u', '/\//u', '/\s/u', '/:/u', '/\-/u', '/\./u');
				$configNameReplace = array('', '', '\s?', ':?', '\-?', '');
				$regexpr = sprintf("/%s\s*%s/iu", preg_replace($configNameExpr, $configNameReplace, $item->name), preg_replace('/\.x|х/iu', '' , $item->versionName));
				if(preg_match($regexpr, $content)){
					$job->configId = $item->id;
					$job->versionId = $item->versionId;
					break;
				}
			}
		}
	}
	protected function setCP($job, &$content){
		if($this->listCP){
			foreach($this->listCP as $item){
				if(preg_match("/{$item->name}/iu", $content)){
					$job->placeId = $item->id;
					break;
				}
			}
		}
	}
}
final class ItemCAV{
	public $id;
	public $name;
	public $versionId;
	public $versionName;
	public function __construct($id, $name, $versionId, $versionName){
		$this->id = $id;
		$this->name = $name;
		$this->versionId = $versionId;
		$this->versionName = $versionName;
	}
	public function __toString(){
		return $this->name." ".$this->versionName;
	}
}
final class ItemCP{
	public $id;
	public $name;
	public $countryId;
	public $countryName;
	public function __construct($id, $name, $country_id, $country_name){
		$this->id = $id;
		$this->name = $name;
		$this->countryId = $country_id;
		$this->countryName = $country_name;
	}
	public function __toString(){
		return $this->name." ".$this->countryName;
	}
}
?>