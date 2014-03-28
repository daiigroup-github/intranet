<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'leaveReport-form',
	'enableAjaxValidation' => true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		'class' => 'form-horizontal well',)));
?>
<h3>ค้นหา</h3>
<hr />

<!--div class="control-group">
	<label class="control-label">ประเภทการลา</label>
	<div class="controls">
<?php
echo $form->dropDownList($leaveModel, 'leaveType', $leaveModel->getLeaveTypeArray(), array(
	'prompt' => '-',
	'class' => 'input-small'));
?>
	</div>
</div-->

<?php if (Yii::app()->controller->action->id == 'index' || Yii::app()->controller->action->id == 'summaryLeaveReport'): ?>
	<div class="control-group">
		<label class="control-label">บริษัท</label>
		<div class="controls">
			<?php echo $form->dropDownList($leaveModel, 'companyId', Company::model()->getAllCompanyHaveEmployee()); ?>
		</div>
	</div>
<?php endif; ?>

<div class="control-group">
	<label class="control-label">ช่วงวันที่ต้องการค้นหา</label>
	<div class="controls">
		ตั้งแต่
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			//'name'=>'startDate',
			'model' => $leaveModel,
			'attribute' => 'startDate',
			'language' => 'en',
			'options' => array(
				'showAnim' => 'fold',
				'dateFormat' => 'yy-mm-dd'
			),
			'htmlOptions' => array(
				'class' => 'input-small'),));
		?>
		- ถึง
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			//'name'=>'endDate',
			'model' => $leaveModel,
			'attribute' => 'endDate',
			'language' => 'en',
			'options' => array(
				'showAnim' => 'fold',
				'dateFormat' => 'yy-mm-dd'
			),
			'htmlOptions' => array(
				'class' => 'input-small'),));
		?>
	</div>
</div>

<?php if (Yii::app()->controller->action->id == 'index'): ?>
	<div class="control-group">
		<label class="control-label">แสดงเฉพาะรายการก่อนตัดรอบ</label>
		<div class="controls">
			<?php echo $form->checkBox($leaveModel, 'inAround'); ?>
		</div>
	</div>
<?php endif; ?>

<!--div class="control-group">
	<label class="control-label">ฝ่าย</label>
	<div class="controls">
		<select></select> - <select></select>
	</div>
</div-->
<div class="control-group">
	<div class="controls">
		<?php
		echo CHtml::submitButton('ค้นหา', array(
			'class' => 'btn btn-primary'));
		?>
	</div>
</div>
<?php $this->endWidget(); ?>

