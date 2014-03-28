<?php
$this->pageHeader = 'Create Docuemnt : ' . $model->documentTypeName;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery.ui.all.css" />

<div class="form wide well">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'document-form',
		'enableAjaxValidation' => false,
	));
	?>

	<?php
	foreach ($model->documentTemplate as $dt)
	{
		echo '<label>' . $dt->documentTemplateField->documentTemplateFieldName . '</label>';
		switch ($dt->documentControlType->documentControlTypeName)
		{
			case 'textField':
				echo $form->textField($model, 'input[]');
				break;

			case 'date':
				Yii::app()->clientScript->registerScript('datepicker', "
						$(function(){
							$('#datepicker" . $dt->id . "').datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: 'yy-mm-dd',
							});
						});
					");
				echo $form->textField($model, 'input[]', array(
					'id' => 'datepicker' . $dt->id
				));
				break;
		}
	}
	?>

	<?php
	$this->renderPartial('_form_item', array(
		'documentItemModel' => $documentItemModel,
		'form' => $form,
	));
	?>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->