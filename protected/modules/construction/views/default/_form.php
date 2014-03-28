<div class="form well">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'qtech-project-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class' => 'form-horizontal',
		),
	));
	?>

	<div class="row">
		<div class="span">
			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php
			echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
				'class' => 'alert alert-error'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'productCatId'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'productCatId', ProductCategory::getAllProductCat()); ?>
			<?php echo $form->error($model, 'productCatId'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'name'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'name', array(
				'size' => 60,
				'maxlength' => 100));
			?>
			<?php echo $form->error($model, 'name'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'detail'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'detail', array(
				'size' => 60,
				'maxlength' => 255));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'price'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'price'); ?>
			<?php echo $form->error($model, 'price'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'address'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'address', array(
				'size' => 60,
				'maxlength' => 255));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'customerId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'customerId', Customer::getAllCustomer(), array(
				'prompt' => '-- Select --'));
			?>
			<?php echo $form->error($model, 'customerId'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'startDate'); ?></label>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'startDate',
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
				),
				'htmlOptions' => array(
					'size' => '10', // textField size
					'maxlength' => '10', // textField maxlength
				),
			));
			?>
			<?php echo $form->error($model, 'startDate'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'duration'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'duration'); ?>
			<?php echo $form->error($model, 'duration'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'engineerId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'engineerId', Employee::model()->getAllEngineer(), array(
				'prompt' => '-- Select --'));
			?>
			<?php echo $form->error($model, 'engineerId'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Next' : 'Save', array(
			'class' => 'btn btn-primary'));
		?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->