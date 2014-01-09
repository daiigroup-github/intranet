<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class'=>'alert alert-error'));
$form->error($model, 'groupName');
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'groupName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'groupName', array(
				'size'=>40,
				'maxlength'=>40));
			?>
		</div>
	</div>
</fieldset>

<hr />

<div class="row">
	<div class="span9">
		<!-- employee  -->
		<?php //echo $form->checkBoxList($employeeModel, 'employeeId', CHtml::listData($employeeModel->findAll(), 'employeeId', 'username'));?>

		<?php
		$company = Company::model()->getAllCompany();

		$groupMember = GroupMember::model()->getAllGroupMemberByGroupId($model->groupId);

		foreach($company as $k=> $v)
		{
			if(!$k)
				continue;

			$employee = Employee::model()->getAllEmployeeByCompanyId($k);

			if(sizeof($employee) <= 1)
				continue;

			echo '<h3>' . $v . '</h3>';

			echo '<ul class="thumbnails">';

			foreach($employee as $employeeId=> $employeeName)
			{
				if(!$employeeId)
					continue;

				$checked = (in_array($employeeId, $groupMember)) ? 'checked' : '';

				echo '<li class="span3">
							<label class="checkbox inline">' .
				$form->checkbox($employeeModel, 'employeeId[' . $employeeId . ']', array(
					'value'=>$employeeId,
					'checked'=>$checked)) . ' ' . $employeeName .
				'</label>
						</li>';
			}

			echo '</ul>';

			echo '<hr />';
		}
		?>
	</div>
</div>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class'=>'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->