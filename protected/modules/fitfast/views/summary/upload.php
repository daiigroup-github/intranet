<?php
$this->pageHeader = strtoupper($fitfastTargetModel->fitfast->typeText($fitfastTargetModel->fitfast->type)).' เดือน '. $fitfastTargetModel->month;
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'fit-and-fast-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'',
		'enctype'=>'multipart/form-data'),
	));
?>
<div class="alert alert-info">
	หัวข้อ : <?php echo $fitfastTargetModel->fitfast->title; ?><br />
	เป้าหมาย : <?php echo $fitfastTargetModel->target; ?>
</div>
<div class="row-fluid">
	<div class="span8">
		<?php echo $form->fileField($fitfastTargetModel, 'file'); ?>
	</div>
</div>
<div class="form-actions">
	<?php
	echo CHtml::submitButton('Upload', array(
		'class'=>'btn btn-primary'));
	?>
</div>
<?php $this->endWidget(); ?>
