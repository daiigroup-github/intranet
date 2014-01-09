<?php
$this->pageHeader = 'รายงานใบแก้ไขเวลา';
?>

<?php
$this->renderPartial('_searchFormFixTime', array(
	'documentItem'=>$documentItem));
?>

<?php
if($employeeModels)
	$this->renderPartial('_fixTimeReportItem', array(
		'employeeModels'=>$employeeModels,
		'documentItem'=>$documentItem));?>