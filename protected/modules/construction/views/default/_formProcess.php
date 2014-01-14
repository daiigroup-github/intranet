<?php Yii::import('application.extensions.jqrelcopy.*') ?>
<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'process-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class' => 'form-horizontal',
		),
	));
	?>

	<div class="row">
		<div class="span">
			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php
			echo $form->errorSummary($processModel, 'Please fix the following input errors', '', array(
				'class' => 'alert alert-error'));
			?>
		</div>
	</div>

	<?php
	if ($processArray):
		foreach ($processArray as $p):
			?>
			<div class="well">
				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($processModel, 'name'); ?></label>
					<div class="controls">
						<?php
						echo $form->textField($processModel, 'name[]', array(
							'size' => 60,
							'maxlength' => 100,
							'value' => $p['name']));
						?>
						<?php echo $form->error($processModel, 'name'); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($processModel, 'detail'); ?></label>
					<div class="controls">
						<?php
						echo $form->textField($processModel, 'detail[]', array(
							'size' => 60,
							'maxlength' => 255,
							'value' => $p['detail']));
						?>
						<?php echo $form->error($processModel, 'detail'); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($processModel, 'price'); ?></label>
					<div class="controls">
						<?php
						echo $form->textField($processModel, 'price[]', array(
							'value' => $p['price']));
						?>
						<?php echo $form->error($processModel, 'price'); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($processModel, 'percent'); ?></label>
					<div class="controls">
						<?php
						echo $form->textField($processModel, 'percent[]', array(
							'size' => 60,
							'maxlength' => 255,
							'value' => $p['percent']));
						?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($processModel, 'startDate'); ?></label>
					<div class="controls">
						<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model' => $processModel,
							'name' => 'startDate',
							'attribute' => 'startDate[]',
							'options' => array(
								'dateFormat' => 'yy-mm-dd',
							),
							'htmlOptions' => array(
								'size' => '10', // textField size
								'maxlength' => '10', // textField maxlength
								'id' => 'startDate' . uniqid(),
								'value' => $p['startDate']
							),
						));
						?>
						<?php echo $form->error($processModel, 'startDate'); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($processModel, 'duration'); ?></label>
					<div class="controls">
						<?php
						echo $form->textField($processModel, 'duration[]', array(
							'value' => $p['duration']));
						?>
						<?php echo $form->error($processModel, 'duration'); ?>
					</div>
				</div>
			</div>
			<?php
		endforeach;
	endif;
	?>

	<?php
	$datePickerConfig = array(
		'model' => $processModel,
		'name' => 'startDate',
		'attribute' => 'startDate[]',
		'options' => array(
			'showAnim' => 'fold',
	));

	$this->widget('ext.jqrelcopy.JQRelcopy', array(
		//the id of the 'Copy' link in the view, see below.
		'id' => 'copylink',
		//add a icon image tag instead of the text
		//leave empty to disable removing
		'removeText' => 'Remove',
		//htmlOptions of the remove link
		'removeHtmlOptions' => array(
			'style' => 'color:red'),
		//options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
		'options' => array(
			//A class to attach to each copy
			'copyClass' => 'newcopy',
			// The number of allowed copies. Default: 0 is unlimited
			'limit' => 5,
			//Option to clear each copies text input fields or textarea
			'clearInputs' => true,
			//A jQuery selector used to exclude an element and its children
			'excludeSelector' => '.skipcopy',
			//Additional HTML to attach at the end of each copy.
			'append' => CHtml::tag('span', array(
				'class' => 'hint'), 'You can remove this line'),
		),
		'jsAfterNewId' => JQRelcopy::afterNewIdDatePicker($datePickerConfig),
	));
	?>

	<div class="well copy">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($processModel, 'name'); ?></label>
			<div class="controls">
				<?php
				echo $form->textField($processModel, 'name[]', array(
					'size' => 60,
					'maxlength' => 100));
				?>
				<?php echo $form->error($processModel, 'name'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($processModel, 'detail'); ?></label>
			<div class="controls">
				<?php
				echo $form->textField($processModel, 'detail[]', array(
					'size' => 60,
					'maxlength' => 255));
				?>
				<?php echo $form->error($processModel, 'detail'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($processModel, 'price'); ?></label>
			<div class="controls">
				<?php echo $form->textField($processModel, 'price[]'); ?>
				<?php echo $form->error($processModel, 'price'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($processModel, 'percent'); ?></label>
			<div class="controls">
				<?php
				echo $form->textField($processModel, 'percent[]', array(
					'size' => 60,
					'maxlength' => 255));
				?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($processModel, 'startDate'); ?></label>
			<div class="controls">
				<?php
				/* $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				  'model' => $processModel,
				  'attribute' => 'startDate',
				  'options' => array(
				  'dateFormat' => 'yy-mm-dd',
				  ),
				  'htmlOptions' => array(
				  'size' => '10', // textField size
				  'maxlength' => '10', // textField maxlength
				  ),
				  )); */
				$this->widget('zii.widgets.jui.CJuiDatePicker', $datePickerConfig);
				?>
				<?php echo $form->error($processModel, 'startDate'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($processModel, 'duration'); ?></label>
			<div class="controls">
				<?php echo $form->textField($processModel, 'duration[]'); ?>
				<?php echo $form->error($processModel, 'duration'); ?>
			</div>
		</div>
	</div>

	<a id="copylink" href="#" rel=".copy">Copy</a>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton($processModel->isNewRecord ? 'Next' : 'Save', array(
			'class' => 'btn btn-primary'));
		?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->