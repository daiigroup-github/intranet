<?php
$this->pageHeader = 'สร้างเอกสาร ใบลาบวช'; //.$documentType->documentTypeName;
?>

<?php
echo $this->renderPartial('_formOrdinate', array(
	'documentModel'=>$documentModel,
	'documentTypeModel'=>$documentTypeModel,
	'documentType'=>$documentType,
	'workflowLogModel'=>$workflowLogModel,
	'leaveModel'=>$leaveModel,
	'leaveItemModel'=>$leaveItemModel,
	'startDate'=>$startDate,
	'endDate'=>$endDate,
	'error'=>$error,
));
?>