<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'customerId'); ?>
		<?php
		echo $form->textField($model, 'customerId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'createDateTime'); ?>
		<?php echo $form->textField($model, 'createDateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'customerType'); ?>
		<?php echo $form->textField($model, 'customerType'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'customerFnTh'); ?>
		<?php
		echo $form->textField($model, 'customerFnTh', array(
			'size' => 60,
			'maxlength' => 80));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'customerLnTh'); ?>
		<?php
		echo $form->textField($model, 'customerLnTh', array(
			'size' => 60,
			'maxlength' => 120));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'customerCompany'); ?>
		<?php
		echo $form->textField($model, 'customerCompany', array(
			'size' => 60,
			'maxlength' => 120));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email'); ?>
		<?php
		echo $form->textField($model, 'email', array(
			'size' => 60,
			'maxlength' => 120));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'companyValue'); ?>
		<?php
		echo $form->textField($model, 'companyValue', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'saleId'); ?>
		<?php
		echo $form->textField($model, 'saleId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'engineerId'); ?>
		<?php
		echo $form->textField($model, 'engineerId', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'branchId'); ?>
		<?php echo $form->textField($model, 'branchId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'branchValue'); ?>
		<?php
		echo $form->textField($model, 'branchValue', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'address'); ?>
		<?php
		echo $form->textArea($model, 'address', array(
			'rows' => 6,
			'cols' => 50));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'city'); ?>
		<?php
		echo $form->textField($model, 'city', array(
			'size' => 60,
			'maxlength' => 80));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'province'); ?>
		<?php echo $form->textField($model, 'province'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'zipcode'); ?>
		<?php
		echo $form->textField($model, 'zipcode', array(
			'size' => 10,
			'maxlength' => 10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'phone'); ?>
		<?php
		echo $form->textField($model, 'phone', array(
			'size' => 30,
			'maxlength' => 30));
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->