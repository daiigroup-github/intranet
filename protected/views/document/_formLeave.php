<script type="text/javascript"
src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui/js/jquery-ui.min.js"></script>
<link
	rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery.ui.all.css" />
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'document-form',
		'enableAjaxValidation'=>true,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal',
		)
	));

	Yii::import('ext.jqrelcopy.JQRelcopy');

	$datePickerConfig = array(
		'name'=>'dayofbirth',
		'language'=>'de',
		'options'=>array(
			'showAnim'=>'fold',
			'dateFormat'=>'yy-mm-dd')
	);

	$flag = (isset($startDate) && isset($endDate)) ? true : false;
	?>

<fieldset>
	<h3>รายละเอียด</h3>
	<!-- <p class="help-block alert">การลาไม่สามารถยกเลิกได้</p> -->
	<p class="help-block alert"><?php echo nl2br($documentType->documentTypeDescription); ?></p>

	<table class="table table-striped table-bordered table-condensed ">
		<thead>
			<tr class="alert-success">
				<th>ประเภท</th><th>คงเหลือ</th><th>รออนุมัติ</th><th>ลาได้อีก</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ลาป่วย</td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainLeaveDateByLeaveType(1, Yii::app()->user->id)); ?></td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainWaitApproveLeaveDateByLeaveType(1, Yii::app()->user->id)); ?></td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainLeaveDateByLeaveType(1, Yii::app()->user->id) - Leave::model()->remainWaitApproveLeaveDateByLeaveType(1, Yii::app()->user->id)); ?></td>
			</tr>
			<tr>
				<td>ลากิจ</td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainLeaveDateByLeaveType(2, Yii::app()->user->id)); ?></td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainWaitApproveLeaveDateByLeaveType(2, Yii::app()->user->id)); ?></td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainLeaveDateByLeaveType(2, Yii::app()->user->id) - Leave::model()->remainWaitApproveLeaveDateByLeaveType(2, Yii::app()->user->id)); ?></td>
			</tr>
			<tr>
				<td>ลาพักร้อน</td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainLeaveDateByLeaveType(3, Yii::app()->user->id)); ?></td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainWaitApproveLeaveDateByLeaveType(3, Yii::app()->user->id)); ?></td><td><?php echo Leave::model()->remainLeaveText(Leave::model()->remainLeaveDateByLeaveType(3, Yii::app()->user->id) - Leave::model()->remainWaitApproveLeaveDateByLeaveType(3, Yii::app()->user->id)); ?></td>
			</tr>
		</tbody>
	</table>
	<hr />

	<p class="alert">
		<?php
		$calendarModel = Calendar::model()->findNextSalaryDate();
		$today = explode(' ', $this->dateThai(date('Y-m-d'), 1));
		?>
		สามารถลาป่วยเดือน <strong><?php echo $today[1]; ?></strong> ได้ไม่เกินวันที่ <strong><?php echo $this->dateThai($calendarModel->date, 1); ?> เวลา 14.00 น.</strong>
	</p>

	<?php if($error): ?>
		<p class="alert alert-danger">
			<?php echo $error; ?>
		</p>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label">ประเภทการลา</label>
		<div class="controls">
			<?php
			echo (!$leaveModel->leaveType) ? $form->dropDownList($leaveModel, 'leaveType', $leaveModel->getNormalLeaveTypeArray(), array(
					'prompt'=>'-',
					'class'=>'input-small'
				)) : $leaveModel->leaveTypeText($leaveModel->leaveType) . $form->hiddenField($leaveModel, 'leaveType') . ' / วันลาคงเหลือ ' . Leave::model()->remainLeaveDateByLeaveType($leaveModel->leaveType, Yii::app()->user->id);
			?>
		</div>
	</div>

	<?php if(!isset($startDate) && !isset($endDate)): ?>
		<div class="control-group">
			<label class="control-label">วันที่ต้องการลา</label>
			<div class="controls">
				ตั้งแต่
				<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					//'name'=>'startDate',
					'model'=>$leaveModel,
					'attribute'=>'startDate',
					'language'=>'th',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd/mm/yy',
					/* 'onSelect' => 'js:function(dateText, inst) {
					  year = dateText.substring(0, 4);
					  month = dateText.substring(5, 7);
					  day = dateText.substring(8);
					  _year = parseInt(year) + 543 + "";
					  $(this).val(_year + "-" + month + "-" + day);
					  }',
					  'beforeShow' => 'js:function(input, inst){
					  year = input.value.substring(0, 4);
					  month = input.value.substring(5, 7);
					  day = input.value.substring(8);
					  _year = parseInt(year) - 543 + "";
					  $(this).datepicker("setDate", new Date(_year, month - 1, day, 0, 0, 0, 0));
					  }', */
					),
					'htmlOptions'=>array(
						'class'=>'input-small'),
				));
				?>
				- ถึง
				<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					//'name'=>'endDate',
					'model'=>$leaveModel,
					'attribute'=>'endDate',
					'language'=>'th',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd/mm/yy',
					),
					'htmlOptions'=>array(
						'class'=>'input-small'),
				));
				?>
			</div>
		</div>
	<?php endif; ?>

	<hr />

	<?php if($leaveModel->leaveType == 1 || $leaveModel->leaveType == 2): ?>
		<div class="control-group well">
			<label class="control-label">เอกสารประกอบการลา</label>
			<div class="controls">
				<?php echo $form->fileField($leaveModel, 'filePath'); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php
	if(isset($startDate) && isset($endDate))
	{
		$numDate = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24) + 1;
		//echo $numDate;

		for($i = 0; $i < $numDate; $i++)
		{
			$date = date('Y-m-d', strtotime($startDate . " +$i day"));
			?>
			<div class="copy well">
				<div class="control-group">
					<label class="control-label">วันที่ต้องการลา</label>
					<div class="controls">
						<?php echo $this->dateThai($date, 3); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">เวลาที่ต้องการลา</label>
					<div class="controls">
						<?php
						$dayOfWeak = date('N', strtotime($date));


						if($dayOfWeak == 6 || $dayOfWeak == 7)
						{
							$creator = Employee::model()->findByPk(Yii::app()->user->id);
							if($creator->branchId == 1)
							{
								echo 'วันหยุด';
							}
							else
							{
								echo $form->hiddenField($leaveItemModel, 'leaveDate[]', array(
									'value'=>$date));
								echo $form->dropDownList($leaveItemModel, 'leaveTimeType[]', $leaveItemModel->getLeaveItemTimeTypeArray($leaveModel->leaveType));
							}
						}
						else
						{
							echo $form->hiddenField($leaveItemModel, 'leaveDate[]', array(
								'value'=>$date));
							echo $form->dropDownList($leaveItemModel, 'leaveTimeType[]', $leaveItemModel->getLeaveItemTimeTypeArray($leaveModel->leaveType));
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}

		if($leaveModel->isLate)
		{
			echo $form->hiddenField($leaveModel, 'isLate');
		}

		echo '<hr />';
	}
	?>

	<div class="control-group">
		<label class="control-label">Remark</label>
		<div class="controls">
			<?php echo $form->textArea($workflowLogModel, 'remarks'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton($documentModel->isNewRecord ? 'สร้าง' : 'บันทึก', array(
			'confirm'=>'คุณต้องการสร้างเอกสารหรือไม่ ?',
			'class'=>'btn btn-primary'
		));
		?>
	</div>

</fieldset>
<?php $this->endWidget(); ?>

<!-- form -->
