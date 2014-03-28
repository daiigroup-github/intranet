<?php
$this->breadcrumb = '<li>' . CHtml::link('พนักงาน', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'ข้อมูลพนักงาน : ' . strtoupper($model->username);
?>

<?php
if (Yii::app()->user->checkAccess("Employee.Update", $_GET) || Yii::app()->user->checkAccess("Employee.*", $_GET))
{
	;
	?>
	<div class="btn-toolbar">
		<div class="btn-group">
			<a class="btn " href="<?php echo Yii::app()->createUrl('/employee/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i> เพิ่ม</a>
		</div>
	</div>
	<div class="btn-toolbar">
		<div class="btn-group">
			<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/employee/update/' . $model->employeeId); ?>"><i class="icon-edit icon-white"></i> Update</a>
			<?php
			if ($model->status == 1)
			{
				$btnClass = 'btn btn-danger';
				$confirmMessage = 'ต้องการ Lock Employee หรือไม่';
				$linkText = "Lock";
			}
			else if ($model->status = 3)
			{
				$btnClass = 'btn btn-success';
				$confirmMessage = 'ต้องการ UnLock Employee หรือไม่';
				$linkText = "UnLock";
			}
			if ($model->status != 2)
			{
				?>
				<a class="<?php echo $btnClass; ?>" href="<?php echo Yii::app()->createUrl('/employee/toggleLock/' . $model->employeeId); ?>" onclick="return confirm('<?php echo $confirmMessage; ?>')"><i class="icon-lock icon-white"></i> <?php echo $linkText; ?></a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'htmlOptions' => array(
		'class' => 'table table-bordered table-striped table-condensed'),
	'attributes' => array(
		'employeeCode',
		array(
			'name' => 'status',
			'value' => $model->employeeStatusText(),
		),
		array(
			'name' => 'username',
			'value' => strtoupper($model->username),
		),
		array(
			'name' => 'email',
			'value' => CHtml::encode($model->email . '@daiigroup.com'),
		),
		array(
			'name' => 'fullNameTh',
			'value' => CHtml::encode($model->employeePrefixTh() . ' ' . $model->fnTh . ' ' . $model->lnTh),
		),
		array(
			'name' => 'nickName',
			'value' => CHtml::encode(isset($model->nickName) ? $model->nickName : "-"),
		),
		array(
			'name' => 'fullNameEn',
			'value' => CHtml::encode($model->employeePrefixEn() . ' ' . $model->fnEn . ' ' . $model->lnEn),
		),
		array(
			'name' => 'gender',
			'value' => CHtml::encode($model->employeeGenderText()),
		),
		'citizenId',
		'accountNo',
		'ext',
		'mobile',
		array(
			'name' => 'employeeLevelId',
			'value' => CHtml::encode($model->employeeLevelId . ' : ' . $model->level->description),
		),
		'position',
		array(
			'name' => 'companyId',
			'value' => CHtml::encode(isset($model->company->companyNameTh) ? $model->company->companyNameTh : "-"),
		),
		array(
			'name' => 'branchId',
			'value' => CHtml::encode(isset($model->branch->branchName) ? $model->branch->branchName : "-"),
		),
		array(
			'name' => 'divisionId',
			'value' => CHtml::encode(isset($model->division->description) ? $model->division->description : "-"),
		),
		array(
			'name' => 'managerId',
			'value' => CHtml::encode(($model->managerId) ? strtoupper($model->manager->username) : '-'),
		),
		array(
			'name' => 'startDate',
			'value' => CHtml::encode(($model->startDate) ? $this->dateThai($model->startDate, 3) : '-'),
		),
		array(
			'name' => 'proDate',
			'value' => CHtml::encode(($model->proDate) ? $this->dateThai($model->proDate, 3) : '-'),
		),
		array(
			'name' => 'endDate',
			'value' => CHtml::encode(($model->endDate) ? $this->dateThai($model->endDate, 3) : '-'),
		),
		array(
			'name' => 'transferDate',
			'value' => CHtml::encode(($model->transferDate) ? $this->dateThai($model->transferDate, 3) : '-'),
		),
		array(
			'name' => 'birthDate',
			'value' => CHtml::encode(($model->birthDate) ? $this->dateThai($model->birthDate, 3) : '-'),
		),
		/* 'startDate',
		  'proDate',
		  'endDate',
		  'transferDate',
		  'birthDate', */
		array(
			'name' => 'isSale',
			'value' => CHtml::encode(($model->isSale) ? 'Y' : '-'),
		),
		array(
			'name' => 'isEngineer',
			'value' => CHtml::encode(($model->isEngineer) ? 'Y' : '-'),
		),
	),
));
?>
