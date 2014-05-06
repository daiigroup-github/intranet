<?php
/* @var $this TheaterCategoryController */
/* @var $model TheaterCategory */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'theater-category-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal', 
		'enctype' => 'multipart/form-data',),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array('class'=>'alert alert-error')); ?>

	<div class="control-group">
			<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'title',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'description', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
					'model' => $model,
					'attribute' => 'description',
					'filebrowserImageBrowseUrl' => Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files',
				)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'status', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->checkBox($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>
	
	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
