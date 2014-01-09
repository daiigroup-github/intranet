<?php
/* @var $this ConstructionProjectController */
/* @var $model ConstructionProject */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'construction-project-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'createDateTime'); ?>
		<?php echo $form->textField($model, 'createDateTime'); ?>
		<?php echo $form->error($model, 'createDateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'productCatId'); ?>
		<?php
		echo $form->textField($model, 'productCatId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'productCatId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'productValue'); ?>
		<?php
		echo $form->textField($model, 'productValue', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'productValue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php
		echo $form->textField($model, 'name', array(
			'size'=>60,
			'maxlength'=>100));
		?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'detail'); ?>
		<?php
		echo $form->textField($model, 'detail', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'price'); ?>
		<?php echo $form->textField($model, 'price'); ?>
		<?php echo $form->error($model, 'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'imageUrl'); ?>
		<?php
		echo $form->textField($model, 'imageUrl', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'imageUrl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'address'); ?>
		<?php
		echo $form->textField($model, 'address', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'customerId'); ?>
		<?php
		echo $form->textField($model, 'customerId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'customerId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'engineerId'); ?>
		<?php
		echo $form->textField($model, 'engineerId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'engineerId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'saleId'); ?>
		<?php
		echo $form->textField($model, 'saleId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'saleId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'startDate'); ?>
		<?php echo $form->textField($model, 'startDate'); ?>
		<?php echo $form->error($model, 'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'endDate'); ?>
		<?php echo $form->textField($model, 'endDate'); ?>
		<?php echo $form->error($model, 'endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'latitude'); ?>
		<?php
		echo $form->textField($model, 'latitude', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'longitude'); ?>
		<?php
		echo $form->textField($model, 'longitude', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'branchValue'); ?>
		<?php
		echo $form->textField($model, 'branchValue', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'branchValue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->