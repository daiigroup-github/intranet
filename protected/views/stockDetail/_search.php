<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions'=>array(
			'class'=>'form-inline well',
		),
	));
	?>
	<?php
	echo $form->textField($model, 'stockDetailCode', array(
		'size'=>20,
		'maxlength'=>20,
		'placeholder'=>'- เลขที่อุปกรณ์'));
	?>
	<?php
	echo $form->textField($model, 'stockDetailName', array(
		'size'=>60,
		'maxlength'=>500,
		'placeholder'=>'- ชื่ออุปกรณ์'));
	?>
	<?php
	echo $form->dropDownList($model, 'status', array(
		''=>'- สถานะ',
		'1'=>'ใช้งาน',
		'2'=>'ไมใช้งาน'));
	?>
	<?php echo CHtml::submitButton('Search'); ?>
	<?php $this->endWidget(); ?>

</div><!-- search-form -->