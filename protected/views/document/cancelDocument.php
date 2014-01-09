<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal',
	)
	));
?>

<div class="control-group">
	<label class="control-label">เหตุผลที่ลบเอกสาร</label>
	<div class="controls">
		<?php echo $form->textArea($workflowLog, 'remarks'); ?>
	</div>
</div>

<div class="form-actions">
	<?php
	echo CHtml::submitButton('ลบเอกสาร', array(
		'confirm'=>'คุณต้องการลบเอกสารหรือไม่ ?',
		'class'=>'btn btn-danger'));
	?>
</div>

<?php $this->endWidget(); ?>