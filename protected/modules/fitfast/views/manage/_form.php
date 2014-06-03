<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */
/* @var $form CActiveForm */
?>

<div class="row-fluid">
	<div class="span112">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'fit-and-fast-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
				'class'=>'well'),
		));
		?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>

		<div class="row-fluid">
			<div class="span8">
				<?php echo $form->labelEx($model, 'employeeId'); ?>
				<?php
				echo $form->dropDownList($model, 'employeeId', CHtml::listData(Employee::model()->findAll(array(
							'condition'=>'status=1',
							'select'=>'employeeId, concat(fnTh, " ", lnTh) as fnTh',
							'order'=>'fnTh'
						)), 'employeeId', 'fnTh'), array(
					'class'=>'input-block-level',
					'prompt'=>'เลือกพนักงาน'
				));
				?>
				<?php echo $form->error($model, 'employeeId'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($model, 'type'); ?>
				<?php
				echo $form->dropDownList($model, 'type', $model->typeArray(), array(
					'class'=>'input-block-level',
					'prompt'=>'Select Type'));
				?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($model, 'forYear'); ?>
				<?php
				echo $form->dropDownList($model, 'forYear', array(
					date('Y')=>date('Y'),
					date("Y") + 1=>date('Y') + 1), array(
					'class'=>'input-block-level'));
				?>
			</div>
		</div>

		<?php echo $form->labelEx($model, 'title'); ?>
		<?php
		echo $form->textField($model, 'title', array(
			'class'=>'input-block-level'));
		?>
		<?php echo $form->error($model, 'title'); ?>

		<?php echo $form->labelEx($model, 'description'); ?>
		<?php
		echo $form->textArea($model, 'description', array(
			'class'=>'input-block-level'));
		?>
		<?php echo $form->error($model, 'description'); ?>

		<div class="row-fluid">
			<div class="span3">
				<?php echo $form->labelEx($model, 'targetJan'); ?>
				<?php
				echo $form->textField($model, 'targetJan', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetJan'); ?>
			</div>

			<div class="span3">
				<?php echo $form->labelEx($model, 'targetFeb'); ?>
				<?php
				echo $form->textField($model, 'targetFeb', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetFeb'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetMar'); ?>
				<?php
				echo $form->textField($model, 'targetMar', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetMar'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetApr'); ?>
				<?php
				echo $form->textField($model, 'targetApr', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetApr'); ?>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span3">

				<?php echo $form->labelEx($model, 'targetMay'); ?>
				<?php
				echo $form->textField($model, 'targetMay', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetMay'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetJun'); ?>
				<?php
				echo $form->textField($model, 'targetJun', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetJun'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetJul'); ?>
				<?php
				echo $form->textField($model, 'targetJul', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetJul'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetAug'); ?>
				<?php
				echo $form->textField($model, 'targetAug', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetAug'); ?>
			</div>
		</div>

		<div class="row-fluid">

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetSep'); ?>
				<?php
				echo $form->textField($model, 'targetSep', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetSep'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetOct'); ?>
				<?php
				echo $form->textField($model, 'targetOct', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetOct'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetNov'); ?>
				<?php
				echo $form->textField($model, 'targetNov', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetNov'); ?>
			</div>

			<div class="span3">

				<?php echo $form->labelEx($model, 'targetDec'); ?>
				<?php
				echo $form->textField($model, 'targetDec', array(
					'class'=>'input-block-level'));
				?>
				<?php echo $form->error($model, 'targetDec'); ?>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<label class="checkbox">
					<?php
					echo $form->checkBox($model, 'status');
					?>
					<?php echo $model->getAttributeLabel('status'); ?>
				</label>
			</div>
		</div>

		<div class="form-actions">
			<?php
			echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
	<!-- form -->
</div>