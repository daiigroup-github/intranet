<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'document-control-type-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal'
	),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class' => 'alert alert-error'));
$form->error($model, 'documentControlTypeName');
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'documentControlTypeName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentControlTypeName', array(
				'size' => 60,
				'maxlength' => 100));
			?>
		</div>
	</div>
</fieldset>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class' => 'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->