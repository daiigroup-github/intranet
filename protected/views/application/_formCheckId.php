<div class="form wide well">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'customer-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<div class="row">
		<div class="span">
			<p class="note">Fields with <span class="required">*</span> are required.
				<?php
				echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
					'class'=>'alert alert-error'));
				?>
			</p>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'citizenId'); ?></label>
		<div class="controls">
			<?php
			//echo $form->textField($model,'citizenId');
			$this->widget('CMaskedTextField', array(
				'mask'=>'9-9999-99999-99-9',
				'name'=>'EmployeeInfo[citizenId]'));
			echo $form->hiddenField($model, 'citizenId', array(
				'name'=>'EmployeeInfo[citizenFlag]',
				'value'=>$citizenFlag));
			?></div>
	</div>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->