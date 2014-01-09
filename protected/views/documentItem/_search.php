<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'documentItemId'); ?>
		<?php
		echo $form->textField($model, 'documentItemId', array(
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
		<?php echo $form->label($model, 'documentItemName'); ?>
		<?php
		echo $form->textField($model, 'documentItemName', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description1'); ?>
		<?php
		echo $form->textField($model, 'description1', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description2'); ?>
		<?php
		echo $form->textField($model, 'description2', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description3'); ?>
		<?php
		echo $form->textField($model, 'description3', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->