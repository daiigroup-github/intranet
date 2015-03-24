<?php
/* @var $this FitfastTargetController */
/* @var $model FitfastTarget */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fitfast-target-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		//'enctype' => 'multipart/form-data',
	),
)); ?>
    <h3>หัวข้อ : <?php echo $model->fitfast->title;?></h3>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array('class'=>'alert alert-danger')); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'status', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->checkBox($model,'status', array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'employeeId', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $model->fitfast->employee->fnTh.' '.$model->fitfast->employee->lnTh;?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'month', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->dropDownList($model,'month', $model->monthFormat1, array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'month'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'target', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textArea($model,'target',array('rows'=>6, 'cols'=>50, 'class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'target'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'file', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php if($this->action->id=='update') echo CHtml::link('Show File', Yii::app()->baseUrl.$model->file);?>
			<?php echo $form->fileField($model,'file',array('size'=>60,'maxlength'=>255, 'class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'file'); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="col-sm-offset-2 col-sm-9">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->