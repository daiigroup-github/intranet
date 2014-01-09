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
	echo $form->textField($model, 'groupName', array(
		'class'=>'input-medium',
		'placeholder'=>'Group Name'));
	?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->