<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'workflowLogId'); ?>
		<?php
		echo $form->textField($model, 'workflowLogId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'documentId'); ?>
		<?php
		echo $form->textField($model, 'documentId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'workflowStateId'); ?>
		<?php
		echo $form->textField($model, 'workflowStateId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'employeeId'); ?>
		<?php
		echo $form->textField($model, 'employeeId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'createDateTime'); ?>
		<?php echo $form->textField($model, 'createDateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->