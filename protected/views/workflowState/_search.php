<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'workflowStateId'); ?>
		<?php
		echo $form->textField($model, 'workflowStateId', array(
			'size' => 20,
			'maxlength' => 20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'workflowStateName'); ?>
		<?php
		echo $form->textField($model, 'workflowStateName', array(
			'size' => 60,
			'maxlength' => 80));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'currentState'); ?>
		<?php
		echo $form->textField($model, 'currentState', array(
			'size' => 20,
			'maxlength' => 20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'nextState'); ?>
		<?php
		echo $form->textField($model, 'nextState', array(
			'size' => 20,
			'maxlength' => 20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'workflowStatusId'); ?>
		<?php
		echo $form->textField($model, 'workflowStatusId', array(
			'size' => 20,
			'maxlength' => 20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'workflowGroupId'); ?>
		<?php
		echo $form->textField($model, 'workflowGroupId', array(
			'size' => 20,
			'maxlength' => 20));
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->