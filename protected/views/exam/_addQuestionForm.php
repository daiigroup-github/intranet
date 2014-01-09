<?php
$formAdd = $this->beginWidget('CActiveForm', array(
	'id'=>'exam-question-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'),
	));
?>
<p class="note">
	Fields with <span class="required">*</span> are required.
	<?php
	echo $formAdd->errorSummary($examQuestionModel, '', '', array(
		'class'=>'alert alert-error'));
	?>
</p>

<fieldset>
	<!-- Question -->
	<section id="question">
		<div class="well">
			<div class="control-group">
				<label class="control-label"><?php echo $formAdd->labelEx($examQuestionModel, 'title'); ?></label>
				<div class="controls">
					<?php
					echo $formAdd->textField($examQuestionModel, 'title', array(
						'class'=>'input-block-level'));
					?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo $formAdd->labelEx($examQuestionModel, 'description'); ?></label>
				<div class="controls">
					<?php
					echo $formAdd->textArea($examQuestionModel, 'description', array(
						'class'=>'input-block-level'));
					?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo $formAdd->labelEx($examQuestionModel, 'questionType'); ?></label>
				<div class="controls">
					<?php
					echo $formAdd->dropDownList($examQuestionModel, 'questionType', ExamQuestion::model()->getAllExamQuestionType(), array(
						'class'=>'input-block-level',
						'prompt'=>'Select Type',
						'onchange'=>'selectQuestionType();',
						'id'=>'questionType'
					));
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- Choice -->
	<hr />

	<section id="choice" style="display:none;">
		<h3>Choice</h3>
		<div id="multi-choice">
			<div class="alert alert-info choice">
				<div class="control-group">
					<label class="control-label"><?php echo $formAdd->labelEx($examChoiceModel, 'title'); ?></label>
					<div class="controls">
						<?php
						echo $formAdd->textField($examChoiceModel, 'title[]', array(
							'class'=>'input-block-level'));
						?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo $formAdd->labelEx($examChoiceModel, 'value'); ?></label>
					<div class="controls">
						<?php
						echo $formAdd->textField($examChoiceModel, 'value[]', array(
							'class'=>'input-block-level'));
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="range-choice">
			<div class="alert alert-info">
				<div class="control-group">
					<label class="control-label">เริ่ม</label>
					<div class="controls">
						<?php
						echo $formAdd->textField($examQuestionModel, 'startRange', array(
							'class'=>'input-block-level'));
						?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">ถึง</label>
					<div class="controls">
						<?php
						echo $formAdd->textField($examQuestionModel, 'stopRange', array(
							'class'=>'input-block-level'));
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
</fieldset>
<input type="hidden" name='qId' value="<?php echo $qId; ?>" />
<?php $this->endWidget(); ?>
<!-- form -->
<script type="text/javascript">
	function selectQuestionType()
	{
		$("#choice").css('display', 'block');
		var questionType = $("#questionType").val();

		if(questionType == 1)
		{
			$("#multi-choice").css('display', 'block');
			$("#copylink").css('display', 'inline');
			$("#range-choice").css('display', 'none');
		}
		else
		{
			$("#multi-choice").css('display', 'none');
			$("#copylink").css('display', 'none');
			$("#range-choice").css('display', 'block');
		}
	}
</script>