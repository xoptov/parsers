<?php
final class Counter{
	public $completedJobListPage = 0; // ���-�� ���������� ������� ������� ��������.
	public $completedJobPage = 0; // ���-�� ���������� ����������� ������� ��������.
	public $foundDuplicateJobs = 0; // ���-�� ���������� ��������.
	public $savedJobs = 0; // ���-�� ����������� �������� � ��.
	public $referralErrors = 0; // ���-�� ������ �������� �� ������.
	public $errorWritingDatabase = 0; // ���������� ������ ������ � ��.
	public $poorQualityJobs = 0; // ���-�� �������� � ������ ��������� �������.
	public $poorExtressions = 0; // ���-�� ��������� �������������.
}
?>