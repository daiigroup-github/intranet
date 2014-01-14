<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'processSubId'); ?>
		<?php
		echo $form->textField($model, 'processSubId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'qtechProjectId'); ?>
		<?php
		echo $form->textField($model, 'qtechProjectId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'qtechProcessId'); ?>
		<?php
		echo $form->textField($model, 'qtechProcessId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'employeeId'); ?>
		<?php
		echo $form->textField($model, 'employeeId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'processSubName'); ?>
		<?php
		echo $form->textField($model, 'processSubName', array(
			'size' => 60,
			'maxlength' => 100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'processSubDetail'); ?>
		<?php
		echo $form->textField($model, 'processSubDetail', array(
			'size' => 60,
			'maxlength' => 100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'earningPrecent'); ?>
		<?php echo $form->textField($model, 'earningPrecent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contractorCost'); ?>
		<?php echo $form->textField($model, 'contractorCost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'duration'); ?>
		<?php echo $form->textField($model, 'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'paymentNo'); ?>
		<?php echo $form->textField($model, 'paymentNo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->