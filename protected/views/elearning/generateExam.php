<?php
$this->pageHeader = 'Elearning Exam';
?>

<h3>เลือกผู้เข้าสอบ</h3>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'elearning-form',
	'enableAjaxValidation' => false,
	'htmlOptions'=>array(
		'enctype' => 'multipart/form-data',
		'class'=>'form-horizontal well'
		),
));
?>

<div class="control-group">
	<label class="control-label" for="inputEmail">วันสอบ</label>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    //'name'=>'examDate',
		    'model'=>$elearningExamModel,
		    'attribute'=>'examDate',
		    'options'=>array(
			    'dateFormat' => 'yy-mm-dd',
		        'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
		        'changeMonth'=>true,
		        'changeYear'=>true,
		        'yearRange'=>'2013:2020',
		        'minDate' => '2013-06-01',      // minimum date
		        'maxDate' => '2099-12-31',      // maximum date
		    ),
		    'htmlOptions'=>array(
		        'style'=>''
		    ),
		));
		?>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="inputEmail">วันสอบ</label>
	<div class="controls">
		<?php
		$this->widget('ext.jqrelcopy.JQRelcopy', array(
			'id' => 'copylink',
			'removeText' => '<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
			'removeHtmlOptions' => array(
				'style' => 'color:red'),
			'options' => array(
				'copyClass' => 'newcopy',
				'limit' => 0,
				'clearInputs' => true,
				'excludeSelector' => '.skipcopy',
			)
		));
		?>
		<div class='copy'>
			<?php
			echo $form->dropDownList($employeeModel, 'employeeId[]', Employee::model()->getAllEmployee());
			?>
		</div>
		<a id="copylink" href="#" rel=".copy" class="btn"><i class="icon-plus"></i></a>
	</div>
</div>

<div class="form-actions">
	<?php echo CHtml::submitButton('บันทึกข้อมูล', array('class'=>'btn btn-primary'));?>
</div>

<?php $this->endWidget();?>