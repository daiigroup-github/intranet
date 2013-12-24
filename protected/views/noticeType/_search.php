<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'noticeTypeId'); ?>
		<?php
		echo $form->textField($model, 'noticeTypeId', array(
			'size' => 20,
			'maxlength' => 20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noticeTypeName'); ?>
		<?php
		echo $form->textField($model, 'noticeTypeName', array(
			'size' => 60,
			'maxlength' => 500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'createDateTime'); ?>
		<?php echo $form->textField($model, 'createDateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->