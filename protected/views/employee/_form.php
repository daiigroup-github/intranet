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

Yii::app()->clientScript->registerScript('proDatePicker', "
		$(function(){
		$('#proDatePicker').datepicker({
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
	<?php
	if (!$model->isNewRecord) {
		?>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'employeeCode'); ?></label>
			<div class="controls">
				<?php echo $form->textField($model, 'employeeCode'); ?>
			</div>
		</div>
	<?php } ?>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'prefix'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'prefix', $model->getEmployeePrefix()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'gender'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'gender', $model->getEmployeeGender()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fnTh'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'fnTh'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'lnTh'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'lnTh'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'nickName'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'nickName'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fnEn'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'fnEn'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'lnEn'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'lnEn'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'citizenId'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'citizenId'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'accountNo'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'accountNo'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'ext'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'ext'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'mobile'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'mobile'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'employeeLevelId'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'employeeLevelId', EmployeeLevel::model()->getAllEmployeeLevel()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'position'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'position'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'managerId'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'managerId', $model->getAllManager()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'companyId'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'companyId', Company::model()->getAllCompany()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'branchId'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'branchId', Branch::model()->getAllBranch()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'companyDivisionId'); ?></label>
		<div class="controls">
			<?php echo $form->dropDownList($model, 'companyDivisionId', CompanyDivision::model()->getAllCompanyDivision()); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'birthDate'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'birthDate', array(
				'id' => 'birthDatePicker'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'startDate'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'startDate', array(
				'id' => 'startDatePicker'));
			?>
		</div>
	</div>
	<?php if ($this->action->id == "update"): ?>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'proDate'); ?></label>
			<div class="controls">
				<?php
				echo $form->textField($model, 'proDate', array(
					'id' => 'proDatePicker',));
				?>
			</div>
		</div>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'endDate'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'endDate', array(
				'id' => 'endDatePicker'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'transferDate'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'transferDate', array(
				'id' => 'transferDatePicker'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'leaveRemain'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'leaveRemain'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'isSale'); ?></label>
		<div class="controls">
			<?php echo $form->checkbox($model, 'isSale'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'isEngineer'); ?></label>
		<div class="controls">
			<?php echo $form->checkbox($model, 'isEngineer'); ?>
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
<!-- form -->