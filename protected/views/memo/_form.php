<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'memo-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
		)
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<p>
		<?php echo $form->labelEx($model, 'subject'); ?>
		<?php
		echo $form->textField($model, 'subject', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
		<?php echo $form->error($model, 'subject'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'detail'); ?>
		<?php
		$this->widget('application.extensions.extckeditor.ExtCKEditor', array(
			'model'=>$model,
			'attribute'=>'detail', // model atribute
			'language'=>'en', /* default lang, If not declared the language of the project will be used in case of using multiple languages */
			'editorTemplate'=>'full', // Toolbar settings (full, basic, advanced)
		));
		?>
		<?php //echo $form->textArea($model,'detail',array('maxlength'=>3000,'rows'=>10, 'class'=>'input-large'));   ?>
		<?php echo $form->error($model, 'detail'); ?>
	</p>

	<p>
		<?php
		echo CHtml::activeFileField($model, "image", array(
			'class'=>'input-large'));
		?>
	</p>

	<div class="row">
		<div class="span9">
			<!-- employee  -->
			<?php //echo $form->checkBoxList($employeeModel, 'employeeId', CHtml::listData($employeeModel->findAll(), 'employeeId', 'username')); ?>

			<?php
			$company = Company::model()->getAllCompany();
			//$groupMember = GroupMember::model()->getAllGroupMemberByGroupId($model->groupId);
			$groupMember = array(
				);

			foreach($company as $k=> $v)
			{
				if(!$k)
					continue;

				$employee = Employee::model()->getAllEmployeeByCompanyId($k);

				if(sizeof($employee) <= 1)
					continue;

				echo '<h3>' . $v . '</h3>';

				echo '<ul class="thumbnails">';

				foreach($employee as $employeeId=> $employeeName)
				{
					if(!$employeeId)
						continue;

					$checked = (in_array($employeeId, $groupMember)) ? 'checked' : '';

					echo '<li class="span3">
							<label class="checkbox inline">' .
					$form->checkbox($employeeModel, 'employeeId[' . $employeeId . ']', array(
						'value'=>$employeeId,
						'checked'=>$checked)) . ' ' . $employeeName .
					'</label>
						</li>';
				}

				echo '</ul>';

				echo '<hr />';
			}
			?>
		</div>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->