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

	<?php foreach ($projectModel->process as $process): ?>
		<?php
		$datePickerConfig = array(
			'model' => $processSubModel,
			'id' => 'startDate' . $process->processId,
			'name' => 'startDate',
			'attribute' => 'startDate[' . $process->processId . '][]',
			'htmlOptions' => array(
				'class' => 'input-block-level'),
			'options' => array(
				'showAnim' => 'fold',
		));

		$this->widget('ext.jqrelcopy.JQRelcopy', array(
			'id' => 'copylink' . $process->processId,
			'removeText' => '<i class="icon-minus-sign"></i>',
			'removeHtmlOptions' => array(
				'style' => 'color:red'),
			'options' => array(
				'copyClass' => 'newcopy',
				'limit' => 0,
				'clearInputs' => true,
				'excludeSelector' => '.skipcopy',
			/* 'append' => CHtml::tag('span', array(
			  'class' => 'hint'), 'You can remove this line'), */
			),
			'jsAfterNewId' => JQRelcopy::afterNewIdDatePicker($datePickerConfig),
		));
		?>
		<div class="row">
			<div class="span3">
				<?php
				$this->widget('zii.widgets.CDetailView', array(
					'data' => $process,
					'htmlOptions' => array(
						'class' => 'table table-bordered table-striped table-condensed'),
					'attributes' => array(
						array(
							'name' => 'name',
							'value' => $process->name,
						),
						array(
							'name' => 'detail',
							'value' => $process->detail,
						),
						array(
							'name' => 'startDate',
							'type' => 'html',
							'value' => 'เริ่ม : ' . $this->dateThai($process->startDate, 1) . '<br />' .
							'เสร็จ : ' . $this->dateThai($this->dateWithDuration($process->startDate, $process->duration), 2) . '<br />' .
							'ระยะเวลา : ' . $process->duration . ' วัน',
						),
					),
				));
				?>
			</div>	
			<div class="span6">
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<td>Name</td>
						<td>Detail</td>
						<td>Start Date</td>
						<td>Duration</td>
					</tr>
					<tr class="copy<?php echo $process->processId; ?>">
						<td>
							<?php
							echo $form->textField($processSubModel, 'name[' . $process->processId . '][]', array(
								'class' => 'input-block-level'));
							?>
						</td>
						<td>
							<?php
							echo $form->textField($processSubModel, 'detail[' . $process->processId . '][]', array(
								'class' => 'input-block-level'));
							?>
						</td>
						<td>
							<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker', $datePickerConfig);
							?>
						</td>
						<td>
							<?php
							echo $form->textField($processSubModel, 'duration[' . $process->processId . '][]', array(
								'class' => 'input-block-level'));
							?>
						</td>
					</tr>
				</table>
				<a id="copylink<?php echo $process->processId; ?>" href="#" rel=".copy<?php echo $process->processId; ?>">​<i class="icon-plus-sign"></i></a>
			</div>
		</div>
		<hr />
	<?php endforeach; ?>

	<?php $this->endWidget(); ?>

</div><!-- form -->