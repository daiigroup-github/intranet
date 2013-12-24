<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'customer-form',
	'enableAjaxValidation' => false,
	));
?>
<div class="control-group">
	<label class="control-label">
		<?php echo $form->labelEx($applicationInterview, 'interviewDate'); ?></label>
	<div class="controls">
		<?php
		//echo $form->textField($model->applicationInterview,'interviewDate'); 
		$this->widget('application.extensions.timepicker.timepicker', array(
			//'id'=>'takeaway_time',
			'model' => $applicationInterview,
			'name' => 'interviewDate',
			'select' => 'datetime',
			'options' => array(
				'showOn' => 'focus',
				'timeFormat' => 'hh:mm',
				//'hourMin'=> (int) $hourMin,
				//'hourMax'=> (int) $hourMax,
				'hourGrid' => 2,
				'minuteGrid' => 10,
				'value' => (count($oldAppInter) > 0) ? $oldAppInter[0]->interviewDate : "",
			),
		));
		?>
	</div>
</div>
<?php
echo $form->hiddenField($model, "id");
foreach (Employee::model()->findAll("employeeLevelId >=7 AND username <> 'tm' AND status <> 2") as $manager)
{
	echo '<div class="span3"><label class="checkbox inline">';
	$managerId = $manager->employeeId;

	echo $form->radioButtonList($applicationInterview, "isHeadManager[$managerId]", array(
		"$managerId" => "หัวหน้า"), array(
		'name' => 'ApplicationInterview[isHeadManager][]'));
	$checked = '';
	foreach ($oldAppInter as $item)
	{
		if ($manager->employeeId == $item->managerId)
		{
			$checked = 'checked';
			break;
		}
	}
	echo $form->checkbox($manager, "managerId[$managerId]", array(
		'value' => $manager->employeeId,
		'checked' => $checked)) . ' ' . $manager->username;
	echo '</div></li>';
}
?>

<div class="form-actions">
	<?php
	echo CHtml::submitButton('ตกลง', array(
		'confirm' => 'คุณต้องการบันทึกหรือไม่ ?',
		'class' => 'btn btn-danger'));
	?>
</div>
<?php $this->endWidget(); ?>