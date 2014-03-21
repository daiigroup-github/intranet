<?php
/* @var $this FitAndFastController */
/* @var $data FitAndFast */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fitAndFastId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fitAndFastId), array('view', 'id'=>$data->fitAndFastId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sumS')); ?>:</b>
	<?php echo CHtml::encode($data->sumS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sumF')); ?>:</b>
	<?php echo CHtml::encode($data->sumF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetJan')); ?>:</b>
	<?php echo CHtml::encode($data->targetJan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualJan')); ?>:</b>
	<?php echo CHtml::encode($data->actualJan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeJan')); ?>:</b>
	<?php echo CHtml::encode($data->gradeJan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetFeb')); ?>:</b>
	<?php echo CHtml::encode($data->targetFeb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualFeb')); ?>:</b>
	<?php echo CHtml::encode($data->actualFeb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeFeb')); ?>:</b>
	<?php echo CHtml::encode($data->gradeFeb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetMar')); ?>:</b>
	<?php echo CHtml::encode($data->targetMar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualMar')); ?>:</b>
	<?php echo CHtml::encode($data->actualMar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeMar')); ?>:</b>
	<?php echo CHtml::encode($data->gradeMar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetApr')); ?>:</b>
	<?php echo CHtml::encode($data->targetApr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualApr')); ?>:</b>
	<?php echo CHtml::encode($data->actualApr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeApr')); ?>:</b>
	<?php echo CHtml::encode($data->gradeApr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetMay')); ?>:</b>
	<?php echo CHtml::encode($data->targetMay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualMay')); ?>:</b>
	<?php echo CHtml::encode($data->actualMay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeMay')); ?>:</b>
	<?php echo CHtml::encode($data->gradeMay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetJun')); ?>:</b>
	<?php echo CHtml::encode($data->targetJun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualJun')); ?>:</b>
	<?php echo CHtml::encode($data->actualJun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeJun')); ?>:</b>
	<?php echo CHtml::encode($data->gradeJun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetJul')); ?>:</b>
	<?php echo CHtml::encode($data->targetJul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualJul')); ?>:</b>
	<?php echo CHtml::encode($data->actualJul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeJul')); ?>:</b>
	<?php echo CHtml::encode($data->gradeJul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetAug')); ?>:</b>
	<?php echo CHtml::encode($data->targetAug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualAug')); ?>:</b>
	<?php echo CHtml::encode($data->actualAug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeAug')); ?>:</b>
	<?php echo CHtml::encode($data->gradeAug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetSep')); ?>:</b>
	<?php echo CHtml::encode($data->targetSep); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualSep')); ?>:</b>
	<?php echo CHtml::encode($data->actualSep); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeSep')); ?>:</b>
	<?php echo CHtml::encode($data->gradeSep); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetOct')); ?>:</b>
	<?php echo CHtml::encode($data->targetOct); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualOct')); ?>:</b>
	<?php echo CHtml::encode($data->actualOct); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeOct')); ?>:</b>
	<?php echo CHtml::encode($data->gradeOct); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetNov')); ?>:</b>
	<?php echo CHtml::encode($data->targetNov); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualNov')); ?>:</b>
	<?php echo CHtml::encode($data->actualNov); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeNov')); ?>:</b>
	<?php echo CHtml::encode($data->gradeNov); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targetDec')); ?>:</b>
	<?php echo CHtml::encode($data->targetDec); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualDec')); ?>:</b>
	<?php echo CHtml::encode($data->actualDec); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gradeDec')); ?>:</b>
	<?php echo CHtml::encode($data->gradeDec); ?>
	<br />

	*/ ?>

</div>