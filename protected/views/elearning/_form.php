<?php
/* @var $this ElearningController */
/* @var $model Elearning */
/* @var $form CActiveForm */
?>

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'elearning-form',
		'enableAjaxValidation' => false,
		'htmlOptions'=>array(
			'enctype' => 'multipart/form-data',
			),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->labelEx($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('class'=>'input-block-level'));?>
		<?php echo $form->error($model, 'title'); ?>

		<?php echo $form->labelEx($model, 'pdfFile'); ?>
		<?php echo $form->fileField($model, 'pdfFile');?>
		<?php echo $form->error($model, 'pdfFile'); ?>

		<?php echo $form->labelEx($model, 'description'); ?>
		<?php
		$this->widget('ext.editMe.widgets.ExtEditMe', array(
			'model'=>$model,
    		'attribute'=>'description',
    		'value'=>$model->description,
		));
		?>
		<?php echo $form->error($model, 'description'); ?>

		<?php echo $form->labelEx($model, 'numberOfQuestion'); ?>
		<?php echo $form->textField($model, 'numberOfQuestion', array('class'=>'input-block-level'));?>
		<?php echo $form->error($model, 'numberOfQuestion'); ?>

		<?php echo $form->labelEx($model, 'parentId'); ?>
		<?php echo $form->dropDownList($model, 'parentId', CHtml::listData(Elearning::model()->findAll(), 'elearningId', 'title'), array('prompt' => '--- Top ---',));?>
		<?php echo $form->error($model, 'parentId'); ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>
