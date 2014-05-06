<?php
/* @var $this TheaterMovieController */
/* @var $model TheaterMovie */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'theater-movie-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, '', '', array(
	'class'=>'alert alert-error'));
?>

<div class="control-group">
	<?php
	echo $form->labelEx($model, 'theaterCategoryId', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		echo Select2::activeDropDownList($model, "theaterCategoryId", TheaterCategory::model()->findAllTheaterCategoryArray(), array(
			'prompt'=>'-- เลือกหมวดหมู่ --',
			'class'=>'input-block-level',
			'select2Options'=>array(
				'maximumSelectionSize'=>1,
			),
		));
		?>
		<?php echo $form->error($model, 'theaterCategoryId'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'title', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		echo $form->textField($model, 'title', array(
			'class'=>'input-block-level'));
		?>
		<?php echo $form->error($model, 'title'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'description', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		$this->widget('ext.editMe.widgets.ExtEditMe', array(
			'model'=>$model,
			'attribute'=>'description',
			'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files',
		));
		?>
		<?php echo $form->error($model, 'description'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'length', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		echo $form->textField($model, 'length', array(
			'class'=>'input-block-level'));
		?>
		<?php echo $form->error($model, 'length'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'url', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		echo $form->textField($model, 'url', array(
			'class'=>'input-block-level'));
		?>
		<?php echo $form->error($model, 'url'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'image', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		if($this->action->id == 'update')
			echo CHtml::image(Yii::app()->baseUrl . $model->image, '', array(
				'style'=>'width:150px;'));
		?>
		<?php echo $form->fileField($model, 'image'); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'screenshotImage', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php
		if($this->action->id == 'update')
			echo CHtml::image(Yii::app()->baseUrl . $model->screenshotImage, '', array(
				'style'=>'width:150px;'));
		?>
		<?php echo $form->fileField($model, 'screenshotImage'); ?>
		<?php echo $form->error($model, 'screenshotImage'); ?>
	</div>
</div>
<div class="control-group">
	<?php
	echo $form->labelEx($model, 'status', array(
		'class'=>'control-label'));
	?>
	<div class='controls'>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>
</div>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class'=>'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
