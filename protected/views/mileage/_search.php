<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	));
	?>

	<div class="row">
		<div class="span2">			
			<?php echo $form->labelEx($model, 'employeeId'); ?>
			<?php
			echo $form->dropDownList($model, 'employeeId', Mileage::getAllEmployeeInMileage(), array(
				'class' => 'input-small'));
			?>
			<?php echo $form->error($model, 'employeeId'); ?>
		</div>
		<div class="span2">			
			<?php echo $form->labelEx($model, 'startDate'); ?>
			<?php
			echo $form->textField($model, 'startDate', array(
				'class' => 'input-small'));
			?>
			<?php echo $form->error($model, 'startDate'); ?>
		</div>
		<div class="span2">			
			<?php echo $form->labelEx($model, 'endDate'); ?>
			<?php
			echo $form->textField($model, 'endDate', array(
				'class' => 'input-small'));
			?>
			<?php echo $form->error($model, 'endDate'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton('Search', array(
			'class' => 'btn btn-primary'));
		?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->

<?php Mileage::getAllEmployeeInMileage(); ?>