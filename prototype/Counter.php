<?php
final class Counter{
	public $completedJobListPage = 0; // Кол-во пройденных страниц списков вакансий.
	public $completedJobPage = 0; // Кол-во пройденных внутреннних страниц вакансий.
	public $foundDuplicateJobs = 0; // Кол-во дубликатов вакансий.
	public $savedJobs = 0; // Кол-во сохраненных вакансий в БД.
	public $referralErrors = 0; // Кол-во ошибок перехода по ссылке.
	public $errorWritingDatabase = 0; // Количество ошибок записи в БД.
	public $poorQualityJobs = 0; // Кол-во вакансий с плохим качеством разбора.
	public $poorExtressions = 0; // Кол-во неудачных распознований.
}
?>