<?php
$this->pageHeader = 'รายงานใบลา';
?>

<?php
$this->renderPartial('_searchForm', array(
	'leaveModel' => $leaveModel));
?>

<?php
if ($employeeModels)
	$this->renderPartial('_leaveReportItem', array(
		'employeeModels' => $employeeModels,
		'leaveModel' => $leaveModel));
?>