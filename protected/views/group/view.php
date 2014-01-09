<?php
$this->breadcrumb = '<li>' . CHtml::link('Groups', Yii::app()->createUrl('/group')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'View Group : ' . strtoupper($model->groupName);
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/group/update/' . $model->groupId); ?>"><i class="icon-edit icon-white"></i> Update</a>
	</div>
</div>

<h3>Group Member</h3>

<ol>
	<?php
//print_r($model->groupMember);
	foreach($model->groupMember as $groupMember)
	{
		echo '<li>' . $groupMember->employee->username . ' : ' . $groupMember->employee->fnTh . ' ' . $groupMember->employee->lnTh . '</li>';
	}
	?>
</ol>