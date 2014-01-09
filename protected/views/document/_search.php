<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery.ui.all.css" />

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions'=>array(
			'class'=>'form-horizontal well',
		),
	));

	Yii::app()->clientScript->registerScript('datepicker', "
	$(function(){
		$('#datePicker').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
		});
	});
");

	Yii::app()->clientScript->registerScript('datepicker2', "
	$(function(){
		$('#datePicker2').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
		});
	});
");
	?>
	<div class="control-group">
		<?php
		echo $form->label($model, 'documentCode', array(
			'class'=>'control-label'));
		?>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentCode', array(
				'class'=>'span2',
				'placeholder'=>'เลขที่เอกสาร'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">ช่วงเวลา</label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'startDate', array(
				'class'=>'input-small',
				'id'=>'datePicker',
				'placeholder'=>'วันเริ่มต้น'));
			?> -
			<?php
			echo $form->textField($model, 'endDate', array(
				'class'=>'input-small',
				'id'=>'datePicker2',
				'placeholder'=>'วันสิ้นสุด'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">เอกสาร</label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'documentTypeId', CHtml::listData(DocumentType::model()->findAll(), 'documentTypeId', 'documentTypeName'), array(
				'class'=>'input-medium',
				'prompt'=>'เอกสารทั้งหมด'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">เฉพาะเอกสารที่สร้างเอง</label>
		<div class="controls">
			<?php
			echo $form->checkBox($model, 'isOwner', array(
				'class'=>'input-medium'));
			?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<?php
			echo CHtml::submitButton('ค้นหา', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->