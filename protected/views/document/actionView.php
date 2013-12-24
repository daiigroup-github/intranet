<hr />

<h3>ดำเนินการ</h3>

<div class="control-group">
	<label class="control-label">ดำเนินการ</label>
	<div class="controls">
		<?php
		echo $form->radioButtonList($workflowStateModel, 'workflowStatusId', $workflowStatus, array(
			'class' => '',
			'separator' => '&nbsp;',
			'labelOptions' => array(
				'style' => 'display:inline')));
		?>
	</div>
</div>

<?php
if ($currentWorkflowState->requireConfirm)
{
	echo '<div>Confirm :';

	if (isset($documentWorkflowModel->employee))
	{
		$staffName = $documentWorkflowModel->employee->username;
	}
	else
	{
		$grorpMember = GroupMember::model()->findAll("groupId = :groupId", array(
			":groupId" => $documentWorkflowModel->groupId));
		$employeeString = "";
		foreach ($grorpMember as $item)
		{
			$employee = Employee::model()->findByPk($item->employeeId);
			$employeeString .= $employee->username . " ";
		}
		$staffName = $employeeString;
	}

	$ownerName = (isset($documentWorkflowModel->document->employee)) ? $documentWorkflowModel->document->employee->username : " ";
	if ($documentWorkflowModel->document->employee->status == 2)
	{
		$ownerName .= " พนักงานลากออกแล้ว(สามารถจัดการได้เลยไม่ต้องระบุรหัสผ่าน) ";
	}
	echo "ผู้แจกของ : $staffName " . $form->passwordField($workflowStateModel, 'staffPwd') . " ";
	echo "ผู้รับของ : $ownerName " . $form->passwordField($workflowStateModel, 'ownerPwd');

	echo '</div>';
}
?>

<div class="control-group">
	<label class="control-label">หมายเหตุ</label>
	<div class="controls">
		<?php echo $form->textArea($workflowLogModel, 'remarks'); ?>
	</div>
</div>

<div class="form-actions"><?php
	echo CHtml::submitButton('Save', array(
		'confirm' => 'คุณต้องการดำเนินการกับเอกสารนี้ ?',
		'class' => 'btn btn-primary'));
	?></div>
