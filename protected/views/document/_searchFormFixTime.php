<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'leaveReport-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal well',)));
?>
<h3>ค้นหา</h3>
<hr />

<!--div class="control-group">
	<label class="control-label">ประเภทการลา</label>
	<div class="controls">
<?php /* echo $form->dropDownList($leaveModel, 'leaveType', $leaveModel->getLeaveTypeArray(), array(
  'prompt' => '-',
  'class' => 'input-small')); */ ?>
	</div>
</div-->

<!--<div class="control-group">
<label class="control-label">บริษัท</label>
	<div class="controls">
<?php echo $form->dropDownList($documentItem, 'companyId', Company::model()->getAllCompanyHaveEmployee()); ?>
	</div>
</div>-->

<div class="control-group">
	<label class="control-label">ช่วงวันที่ต้องการ</label>
	<div class="controls">
		ตั้งแต่
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			//'name'=>'startDate',
			'model'=>$documentItem,
			'attribute'=>'startDate',
			'language'=>'en',
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd'
			),
			'htmlOptions'=>array(
				'class'=>'input-small'),));
		?>
		- ถึง
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			//'name'=>'endDate',
			'model'=>$documentItem,
			'attribute'=>'endDate',
			'language'=>'en',
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd'
			),
			'htmlOptions'=>array(
				'class'=>'input-small'),));
		?>
	</div>
</div>

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
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>
<?php $this->endWidget(); ?>

