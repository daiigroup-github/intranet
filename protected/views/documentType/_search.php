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
		'placeholder'=>'Document Name'));
	?>
	<?php
	echo $form->textField($model, 'workflowGroupId', array(
		'size'=>20,
		'maxlength'=>20));
	?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->