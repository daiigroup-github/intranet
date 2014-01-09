<div class="form">
	<?php
	$this->widget('ext.jqrelcopy.JQRelcopy', array(
		'id'=>'copyFieldLink1',
		'removeText'=>'<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
		'removeHtmlOptions'=>array(
			'style'=>'color:red'),
		'options'=>array(
			'copyClass'=>'newcopy',
			'limit'=>0,
			'clearInputs'=>true,
			'excludeSelector'=>'.skipcopy',
		),
	));
	?>
	<?php
	$this->widget('ext.jqrelcopy.JQRelcopy', array(
		'id'=>'copyFieldLink2',
		'removeText'=>'<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
		'removeHtmlOptions'=>array(
			'style'=>'color:red'),
		'options'=>array(
			'copyClass'=>'newcopy',
			'limit'=>0,
			'clearInputs'=>true,
			'excludeSelector'=>'.skipcopy',
		),
	));
	?>
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'project-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<p>
		<?php echo $form->labelEx($model, 'projectName'); ?>
		<?php
		echo $form->textField($model, 'projectName', array(
			'size'=>60,
			'maxlength'=>100));
		?>
		<?php echo $form->error($model, 'projectName'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'projectDetail'); ?>
		<?php
		echo $form->textField($model, 'projectDetail', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'projectDetail'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'projectPrice'); ?>
		<?php echo $form->textField($model, 'projectPrice'); ?>
		<?php echo $form->error($model, 'projectPrice'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'projectImageName'); ?>
		<?php
		echo $form->textField($model, 'projectImageName', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'projectImageName'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'projectAddress'); ?>
		<?php
		echo $form->textField($model, 'projectAddress', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'projectAddress'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'customerId'); ?>
		<?php echo $form->dropdownList($model, 'customerId', Customer::model()->getAllCustomer()); ?>
		<?php echo $form->error($model, 'customerId'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'startDate'); ?>
		<?php echo $form->textField($model, 'startDate'); ?>
		<?php echo $form->error($model, 'startDate'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'endDate'); ?>
		<?php echo $form->textField($model, 'endDate'); ?>
		<?php echo $form->error($model, 'endDate'); ?>
	</p>

	<p>
		<?php //echo $form->labelEx($model,'latitude');  ?>
		<?php //echo $form->textField($model,'latitude',array('size'=>20,'maxlength'=>20));   ?>
		<?php //echo $form->error($model,'latitude');  ?>
	</p>

	<p>
		<?php //echo $form->labelEx($model,'longitude');  ?>
		<?php //echo $form->textField($model,'longitude',array('size'=>20,'maxlength'=>20));  ?>
		<?php //echo $form->error($model,'longitude'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'branchValue'); ?>
		<?php
		echo $form->textField($model, 'branchValue', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'branchValue'); ?>
	</p>

	<p>
		<?php //echo $form->labelEx($model,'productCatId');   ?>
		<?php //echo $form->textField($model,'productCatId',array('size'=>10,'maxlength'=>10));   ?>
		<?php //echo $form->error($model,'productCatId'); ?>
	</p>

	<p>
		<?php //echo $form->labelEx($model,'productValue');   ?>
		<?php //echo $form->textField($model,'productValue',array('size'=>10,'maxlength'=>10));   ?>
		<?php //echo $form->error($model,'productValue');  ?>
	</p>

	<p>
		<?php //echo $form->labelEx($model,'status');  ?>
		<?php //echo $form->textField($model,'status');  ?>
		<?php //echo $form->error($model,'status'); ?>
	</p>

	<div class="copy1 well">
		<p><h3>Process</h3></p>
		<p>
			<?php echo $form->labelEx($process, 'processName'); ?>
			<?php
			echo $form->textField($process, 'processName', array(
				'size'=>60,
				'maxlength'=>100));
			?>
			<?php echo $form->error($process, 'processName'); ?>
		</p>

		<p>
			<?php echo $form->labelEx($process, 'processDetail'); ?>
			<?php
			echo $form->textField($process, 'processDetail', array(
				'size'=>60,
				'maxlength'=>255));
			?>
			<?php echo $form->error($process, 'processDetail'); ?>
		</p>

		<p>
			<?php echo $form->labelEx($process, 'engineerId'); ?>
			<?php echo $form->dropdownList($process, 'engineerId', Employee::model()->getAllEngineer()); ?>
			<?php echo $form->error($process, 'engineerId'); ?>
		</p>

		<div class="copy2 well">
			<p><h3>Sub Process</h3></p>
			<p>
				<?php echo $form->labelEx($subProcess, 'processName'); ?>
				<?php
				echo $form->textField($subProcess, 'processName', array(
					'size'=>60,
					'maxlength'=>100));
				?>
				<?php echo $form->error($subProcess, 'processName'); ?>
			</p>

			<p>
				<?php echo $form->labelEx($subProcess, 'processDetail'); ?>
				<?php
				echo $form->textField($subProcess, 'processDetail', array(
					'size'=>60,
					'maxlength'=>255));
				?>
				<?php echo $form->error($subProcess, 'processDetail'); ?>
			</p>

			<p>
				<?php echo $form->labelEx($subProcess, 'engineerId'); ?>
				<?php echo $form->dropdownList($subProcess, 'engineerId', Employee::model()->getAllEngineer()); ?>
				<?php echo $form->error($subProcess, 'engineerId'); ?>
			</p>
			<?php
			echo '<a id="copyFieldLink2" href="#" rel=".copy2" class="btn"><i class="icon-plus"></i>เพิ่ม Sub Process</a>';
			?>
		</div>
	</div>

	<p>
		<?php
		echo '<a id="copyFieldLink1" href="#" rel=".copy1" class="btn"><i class="icon-plus"></i>เพิ่ม Process</a>';
		?>
	</p>

	<p>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'สร้างโปรเจ็ค' : 'บันทึก'); ?>
	</p>

	<?php $this->endWidget(); ?>

</div><!-- form -->