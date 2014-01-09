<?php
/* @var $this ApplicationController */
/* @var $model EmployeeInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<p>
		<?php echo $form->label($model, 'appliedPosition'); ?>
		<?php
		echo $form->textField($model, 'appliedPosition', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</p>
	<p>
		<?php echo $form->label($model, 'fnTh'); ?>
		<?php
		echo $form->textField($model, 'fnTh', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</p>
	<p>
		<?php echo $form->label($model, 'lnTh'); ?>
		<?php
		echo $form->textField($model, 'lnTh', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</p>


	<?php $this->endWidget(); ?>

</div><!-- search-form -->