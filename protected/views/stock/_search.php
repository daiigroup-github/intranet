<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-inline well')
	));
?>
<?php echo $form->dropDownList($model, 'stockDetailId', StockDetail::model()->getAllStockDetail()); ?>
<?php //echo $form->textField($model,'stockQuantity',array('size'=>11,'maxlength'=>11));                 ?>
<?php
echo $form->dropDownList($model, 'companyId', Company::model()->getAllCompany(), array(
	'class'=>'input-medium'));
?>
<?php //echo $form->textField($model,'stockUnitPrice',array('size'=>15,'maxlength'=>15));                 ?>
<?php
echo $form->dropDownList($model, 'status', array(
	''=>'- สถานะ',
	'1'=>'ใช้งาน',
	'2'=>'ไมใช้งาน'));
?>
<?php
echo CHtml::submitButton('Search', array(
	'class'=>'btn btn-primary'));
?>
<?php $this->endWidget(); ?>
<!-- search-form -->