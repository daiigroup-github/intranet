<?php
/* @var $this ConstructionProjectController */
/* @var $model ConstructionProject */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'projectId'); ?>
		<?php
		echo $form->textField($model, 'projectId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'createDateTime'); ?>
		<?php echo $form->textField($model, 'createDateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'productCatId'); ?>
		<?php
		echo $form->textField($model, 'productCatId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'productValue'); ?>
		<?php
		echo $form->textField($model, 'productValue', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'name'); ?>
		<?php
		echo $form->textField($model, 'name', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'detail'); ?>
		<?php
		echo $form->textField($model, 'detail', array(
			'size'=>60,
			'maxlength'=>255));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'price'); ?>
		<?php echo $form->textField($model, 'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'imageUrl'); ?>
		<?php
		echo $form->textField($model, 'imageUrl', array(
			'size'=>60,
			'maxlength'=>255));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'address'); ?>
		<?php
		echo $form->textField($model, 'address', array(
			'size'=>60,
			'maxlength'=>255));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'customerId'); ?>
		<?php
		echo $form->textField($model, 'customerId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'engineerId'); ?>
		<?php
		echo $form->textField($model, 'engineerId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'saleId'); ?>
		<?php
		echo $form->textField($model, 'saleId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'startDate'); ?>
		<?php echo $form->textField($model, 'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'endDate'); ?>
		<?php echo $form->textField($model, 'endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'latitude'); ?>
		<?php
		echo $form->textField($model, 'latitude', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'longitude'); ?>
		<?php
		echo $form->textField($model, 'longitude', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'branchValue'); ?>
		<?php
		echo $form->textField($model, 'branchValue', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->