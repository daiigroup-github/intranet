<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'employeeLevelId'); ?>
		<?php echo $form->textField($model, 'employeeLevelId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'level'); ?>
		<?php echo $form->textField($model, 'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php
		echo $form->textField($model, 'description', array(
			'size'=>60,
			'maxlength'=>80));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'code'); ?>
		<?php
		echo $form->textField($model, 'code', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'companyId'); ?>
		<?php
		echo $form->textField($model, 'companyId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'divisionId'); ?>
		<?php echo $form->textField($model, 'divisionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'isManager'); ?>
		<?php echo $form->textField($model, 'isManager'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->