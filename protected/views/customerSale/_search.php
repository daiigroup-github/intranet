<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php
		echo $form->textField($model, 'id', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'customerId'); ?>
		<?php
		echo $form->textField($model, 'customerId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'saleId'); ?>
		<?php
		echo $form->textField($model, 'saleId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'companyValue'); ?>
		<?php
		echo $form->textField($model, 'companyValue', array(
			'size'=>10,
			'maxlength'=>10));
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