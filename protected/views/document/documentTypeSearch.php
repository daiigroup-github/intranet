<div class="form">

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
	echo $form->textField($model, 'documentTypeName', array(
		'class'=>'input-medium',
		'placeholder'=>'ชื่อประเภทเอกสาร'));
	?>
	<?php echo CHtml::submitButton('ค้นหา'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->