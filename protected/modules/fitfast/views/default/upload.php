<?php
$this->pageHeader = $model->attributeLabels()[$field];
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'fit-and-fast-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'',
		'enctype'=>'multipart/form-data'),
	));
?>
<div class="alert alert-info">
	หัวข้อ : <?php echo $title; ?><br />
	เป้าหมาย : <?php echo $target; ?>
</div>
<div class="row-fluid">
	<div class="span8">
		<?php echo $form->fileField($model, $field); ?>
		<?php echo $form->error($model, 'employeeId'); ?>
	</div>
</div>
<div class="form-actions">
	<?php
	echo CHtml::submitButton('Upload', array(
		'class'=>'btn btn-primary'));
	?>
</div>
<?php $this->endWidget(); ?>
