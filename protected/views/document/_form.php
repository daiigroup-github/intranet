<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery.ui.all.css" />

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal',
	)
	));
?>

<fieldset>
	<h3 class="text-error">กรุณาอ่านก่อนสร้างเอกสาร</h3>
	<p class="text-info"><?php
		if(isset($documentType))
		{
			echo nl2br($documentType->documentTypeDescription);
		}
		?></p>
	<hr />
	<?php
	echo CHtml::errorSummary($model, null, null, array(
		'class'=>'text-error'));
	?>
	<?php
	echo CHtml::errorSummary($documentItem, null, null, array(
		'class'=>'text-error'));
	?>
	<?php
	echo $form->hiddenField($model, 'documentTypeId');
	foreach($documentType->documentTemplate as $template)
	{
		$editState = explode(",", $template->editState);
		if($template->status && !$template->isItem)
		{
			$templateName = $template->documentTemplateField->documentTemplateFieldName;
			if(!in_array("-1", $editState))
			{
				echo '<div class="control-group">';

				echo '<label class="control-label">' . $templateName . '</label>';
				if($template->fieldType == 2)
				{
					echo '<label class="text-error">*</label>';
				}
				echo $form->hiddenField($template, "fieldType" . '[' . $template->documentTemplateFieldId . ']', array(
					'value'=>$template->fieldType));
				echo '<div class="controls">';

				$this->selectControlType($template, $form, "control", $template);

				echo $form->error($template, 'control');
				echo '</div>';
				echo '</div>';
			}
			else
			{
				echo '<div class="control-group">';

				//echo '<label class="control-label">'.$templateName.'</label>';
				echo '<div class="controls">';

				echo $form->hiddenField($template, "control" . '[' . $template->documentTemplateFieldId . ']', array(
					'class'=>'input-small'));

				echo $form->error($template, 'control');
				echo '</div>';
				echo '</div>';
			}
		}
	}
	?>

	<hr />


	<?php
	if(count(DocumentTemplate::model()->findItemFieldByDocumentTypeId($documentType->documentTypeId)))
	{
		$this->renderPartial('_itemForm', array(
			'model'=>$model,
			'documentType'=>$documentType,
			'form'=>$form));
	}
	?>

	<div class="control-group">
		<label class="control-label">Remark</label>
		<div class="controls">
			<?php echo $form->textArea($workflowLogModel, 'remarks'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', array(
			'confirm'=>'คุณต้องการสร้างเอกสารหรือไม่ ?',
			'class'=>'btn btn-primary'));
		?>
	</div>


</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->