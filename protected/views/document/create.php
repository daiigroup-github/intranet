<?php

$this->pageHeader = 'สร้างเอกสาร ' . $documentType->documentTypeName;
?>

<?php /*
  <h3>ผู้สร้าง <?php echo $emp->fnTh." ".$emp->lnTh;?> วันที่ <?php echo date("d-m-Y")?></h3>
  <h3>เลขที่เอกสาร <?php echo $documentCode;?></h3>
 */ ?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model,
	'documentType' => $documentType,
	'documentItem' => $documentItem,
	//'stockDetail' => $stockDetail,
	'workflowLogModel' => $workflowLogModel,
));
?>