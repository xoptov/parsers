<?php
class Job{
	public $id;
	public $date;
	public $title;
	public $description;
	public $employType;
	public $experience;
	public $versionId;
	public $configId;
	public $customerId;
	public $placeId;
	public $isBudgetRange;
	public $budgetLow;
	public $budgetHigh;
	public $currency;
	public $status;
	public $restrictDiscussion;
	public $url;
	public $countLancer;
	public $organization;
	public $userIdCookie;
	public $isShow;
	public $fromPhone;
	public $fixenDate;
	public $moneyActSum;
	public $changeDate;
	public $colorEndDate;
	public $isSocialPost;
	public function save($dbh){
		$this->checkCorrect();
		$sql = "INSERT INTO ".STORAGE_TABLE." SET date = :date, title = :title, descr = :descr, employ_type = :employType, experience = :experience, vers_id = :versionId, conf_id = :configId, customerid = :customerId, placeid = :placeId, isbudget_range = :isBudgetRange, budgetlow = :budgetLow, budgethigh = :budgetHigh, currency = :currency, status = :status, restrict_discussion = :restrictDiscussion, url = :url, countLancer = :countLancer, organization = :organization, userid_cookies = :userIdCookie, isshow = :isShow, from_phone = :fromPhone, fixendate = :fixenDate, moneyactsum = :moneyActSum, changedate = :changeDate, colorenddate = :colorEndDate, is_social_post = :isSocialPost";
		$dbh->beginTransaction();
		$sth = $dbh->prepare($sql);
		$sth->bindParam(":date", $this->date, PDO::PARAM_STR);
		$sth->bindParam(":title", $this->title, PDO::PARAM_STR);
		$sth->bindParam(":descr", $this->description, PDO::PARAM_STR);
		$sth->bindParam(":employType", $this->employType, PDO::PARAM_INT);
		$sth->bindParam(":experience", $this->experience, PDO::PARAM_STR);
		$sth->bindParam(":versionId", $this->versionId, PDO::PARAM_INT);
		$sth->bindParam(":configId", $this->configId, PDO::PARAM_INT);
		$sth->bindParam(":customerId", $this->customerId, PDO::PARAM_INT);
		$sth->bindParam(":placeId", $this->placeId, PDO::PARAM_INT);
		$sth->bindParam(":isBudgetRange", $this->isBudgetRange, PDO::PARAM_INT);
		$sth->bindParam(":budgetLow", $this->budgetLow, PDO::PARAM_INT);
		$sth->bindParam(":budgetHigh", $this->budgetHigh, PDO::PARAM_INT);
		$sth->bindParam(":currency", $this->currency, PDO::PARAM_INT);
		$sth->bindParam(":status", $this->status, PDO::PARAM_INT);
		$sth->bindParam(":restrictDiscussion", $this->restrictDiscussion, PDO::PARAM_INT);
		$sth->bindParam(":url", $this->url, PDO::PARAM_STR);
		$sth->bindParam(":countLancer", $this->countLancer, PDO::PARAM_INT);
		$sth->bindParam(":organization", $this->organization, PDO::PARAM_STR);
		$sth->bindParam(":userIdCookie", $this->userIdCookie, PDO::PARAM_INT);
		$sth->bindParam(":isShow", $this->isShow, PDO::PARAM_INT);
		$sth->bindParam(":fromPhone", $this->fromPhone, PDO::PARAM_INT);
		$sth->bindParam(":fixenDate", $this->fixenDate, PDO::PARAM_STR);
		$sth->bindParam(":moneyActSum", $this->moneyActSum, PDO::PARAM_INT);
		$sth->bindParam(":changeDate", $this->changeDate, PDO::PARAM_STR);
		$sth->bindParam(":colorEndDate", $this->colorEndDate, PDO::PARAM_INT);
		$sth->bindParam(":isSocialPost", $this->isSocialPost, PDO::PARAM_INT);
		if($sth->execute()){
			$lastInsertId = $dbh->lastInsertId();
			$siteDomine = SITE_DOMINE;
			$sql = "INSERT INTO ".CONTROL_TABLE." SET id = :id, real_id = :realId, domine = :domine";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(":id", $lastInsertId, PDO::PARAM_INT);
			$sth->bindParam(":realId", $this->id, PDO::PARAM_INT);
			$sth->bindParam(":domine", $siteDomine, PDO::PARAM_STR);
			if($sth->execute()){
				$dbh->commit();
				return true;
			}else{
				$dbh->rollBack();
				throw new WritingException("Ошибка добавления записи о вакансии в таблицу parser_vacancies!\n");
			}
		}else{
			$dbh->rollBack();
			throw new WritingException("Ошибка добавления вакансии в таблицу s_vacancies!\n");
		}
	}
	public function __toString(){
		return $this->id;
	}
	public function checkCorrect(){
		if(empty($this->title)) throw new PoorQualityException();
	}
}
?>