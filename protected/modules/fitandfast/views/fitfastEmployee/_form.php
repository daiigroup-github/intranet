<?php
/* @var $this FitfastEmployeeController */
/* @var $model FitfastEmployee */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fitfast-employee-form',
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array('class'=>'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'status', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'employeeId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'employeeId',array('size'=>10,'maxlength'=>10, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'employeeId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'halfS', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'halfS', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'halfS'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'S', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'S', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'S'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'SS', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'SS', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'SS'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'F', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'F', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'F'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'forYear', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'forYear',array('size'=>4,'maxlength'=>4, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'forYear'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'percent', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'percent', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'percent'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->