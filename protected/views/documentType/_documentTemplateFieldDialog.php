<div class="form" id="jobDialogForm">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'field-form',
		'enableAjaxValidation'=>true,
	));
//I have enableAjaxValidation set to true so i can validate on the fly the
	?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <p>
		<?php echo $form->labelEx($model, 'documentTemplateFieldName'); ?>
		<?php
		echo $form->textField($model, 'documentTemplateFieldName', array(
			'size'=>500,
			'maxlength'=>500));
		?>
		<?php echo $form->error($model, 'jdescr'); ?>
    </p>

    <p>
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</p>

    <p>
		<?php
		echo CHtml::ajaxSubmitButton(Yii::t('Field', 'New Field'), CHtml::normalizeUrl(array(
				'DocumentType/AddNewField',
				'render'=>false)), array(
			'success'=>'js: function(data) {
                        $("#DocumentTemplate_documentTemplateFieldId").append(data);
                        $("#FieldDialog").dialog("close");
                    }'), array(
			'id'=>'closeFieldDialog'));
		?>
    </p>

	<?php $this->endWidget(); ?>

</div>
