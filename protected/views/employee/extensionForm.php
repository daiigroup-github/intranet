<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery.ui.all.css" />

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'employee-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal'),
	));

Yii::app()->clientScript->registerScript('birthDatePicker', "
	$(function(){
		$('#birthDatePicker').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
		});
	});
");

Yii::app()->clientScript->registerScript('startDatePicker', "
	$(function(){
		$('#startDatePicker').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
		});
	});
");

Yii::app()->clientScript->registerScript('endDatePicker', "
		$(function(){
		$('#endDatePicker').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
});
});
		");

Yii::app()->clientScript->registerScript('transferDatePicker', "
		$(function(){
		$('#transferDatePicker').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
});
});
		");
?>

<p class="note">
	Fields with <span class="required">*</span> are required.
	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class' => 'alert alert-error'));
	$form->error($model, 'prefix');
	$form->error($model, 'gender');
	$form->error($model, 'fnTh');
	$form->error($model, 'lnTh');
	$form->error($model, 'nickName');
	$form->error($model, 'fnEn');
	$form->error($model, 'lnEn');
	$form->error($model, 'employeeLevelId');
	$form->error($model, 'position');
	$form->error($model, 'managerId');
	$form->error($model, 'companyId');
	$form->error($model, 'branchId');
	$form->error($model, 'companyDivisionId');
	$form->error($model, 'startDate');
	$form->error($model, 'birthDate');
	$form->error($model, 'isSale');
	$form->error($model, 'isEngineer');
	?>
</p>

<fieldset>


	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fnTh'); ?></label>
		<div class="controls">
			<?php echo $model->fnTh; ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'lnTh'); ?></label>
		<div class="controls">
			<?php echo $model->lnTh; ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'companyDivisionId'); ?></label>
		<div class="controls">
			<?php echo CompanyDivision::model()->findByPk($model->companyDivisionId)->description; ?>
		</div>
	</div>

	<!--	<div class="control-group">
			<label class="control-label"><?php //echo $form->labelEx($model,'nickName');            ?></label>
			<div class="controls">
	<?php //echo $form->textField($model,'nickName');  ?>
			</div>
		</div>-->

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'ext'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'ext'); ?>
		</div>
	</div>

	<!--	<div class="control-group">
			<label class="control-label"><?php //echo $form->labelEx($model,'mobile');            ?></label>
			<div class="controls">
	<?php //echo $form->textField($model,'mobile');  ?>
			</div>
		</div>-->




</fieldset>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class' => 'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->