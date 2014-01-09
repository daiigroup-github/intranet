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
	echo $form->textField($model, 'workflowId', array(
		'class'=>'input-small',
		'placeholder'=>'ID'));
	?>
	<?php
	echo $form->textField($model, 'workflowName', array(
		'class'=>'input-small',
		'placeholder'=>'WF Name'));
	?>
	<?php
	echo $form->dropDownList($model, 'employeeId', Employee::model()->getAllEmployeeByDivisionValue(65535), array(
		'class'=>'input-small'));
	?>
	<?php
	echo $form->textField($model, 'groupId', array(
		'class'=>'input-small',
		'placeholder'=>'Employee Group'));
	?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->