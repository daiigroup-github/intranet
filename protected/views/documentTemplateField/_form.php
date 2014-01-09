<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'document-template-field-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, 'ข้อผิดพลาด', '', array(
	'class'=>'alert alert-error'));
$form->error($model, 'status');
$form->error($model, 'documentTemplateFieldName');
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'documentTemplateFieldName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentTemplateFieldName', array(
				'size'=>60,
				'maxlength'=>500));
			?>
			<p class="help-block">begin charecter in first word is small letter and next word begin big letter</p>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'status'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'status', array(
				'1'=>'Active',
				'0'=>'In Active'));
			?>
		</div>
	</div>
</fieldset>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class'=>'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->