<?php

$this->pageHeader = 'สร้างเอกสาร ใบลา'; //.$documentType->documentTypeName;
?>

<?php

echo $this->renderPartial('_formLeave', array(
	'documentModel' => $documentModel,
	'documentTypeModel' => $documentTypeModel,
	'documentType' => $documentType,
	'workflowLogModel' => $workflowLogModel,
	'leaveModel' => $leaveModel,
	'leaveItemModel' => $leaveItemModel,
	'startDate' => $startDate,
	'endDate' => $endDate,
	'error' => $error,
));
?>