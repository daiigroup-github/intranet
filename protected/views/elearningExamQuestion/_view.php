<?php
/* @var $this ElearningExamQuestionController */
/* @var $data ElearningExamQuestion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->questionId), array('view', 'id'=>$data->questionId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elearningId')); ?>:</b>
	<?php echo CHtml::encode($data->elearningId); ?>
	<br />


</div>