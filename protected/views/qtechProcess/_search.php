<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'qtechProcessId'); ?>
		<?php
		echo $form->textField($model, 'qtechProcessId', array(
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
		<?php echo $form->label($model, 'processName'); ?>
		<?php
		echo $form->textField($model, 'processName', array(
			'size' => 60,
			'maxlength' => 100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'processDetail'); ?>
		<?php
		echo $form->textField($model, 'processDetail', array(
			'size' => 60,
			'maxlength' => 120));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'duration'); ?>
		<?php
		echo $form->textField($model, 'duration', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->