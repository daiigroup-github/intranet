<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui.min.js"></script>

<meta charset="utf-8">
<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>

<script>
	$(function() {
		$("#sortable").sortable({
			placeholder: "ui-state-highlight"
		});
		$("#sortable").disableSelection();
	});
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'workflow-group-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal'),
	));
?>		
<p class="note">
	Fields with <span class="required">*</span> are required.
	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class' => 'alert alert-error'));
	$form->error($model, 'workflowGroupName');
	?>
</p>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'workflowGroupName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'workflowGroupName', array(
				'size' => 60,
				'maxlength' => 80));
			?>
		</div>
	</div>
</fieldset>

<hr />

<?php
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	'id' => 'copylink',
	'removeText' => '<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
	'removeHtmlOptions' => array(
		'style' => 'color:red'),
	'options' => array(
		'copyClass' => 'newcopy',
		'limit' => 0,
		'clearInputs' => true,
		'excludeSelector' => '.skipcopy',
	)
));
?>
<span id="sortable">
	<?php
	if ($model->workflowState)
	{
		foreach ($model->workflowState as $v)
		{
			?>
			<div class="alert alert-success">
				<div class="row-fluid">
					<div class="span3">
						<?php echo $form->labelEx($v, 'workflowStateName'); ?>
						<?php
						echo $form->textField($v, 'workflowStateName[]', array(
							'class' => 'input-medium',
							'value' => $v->workflowStateName));
						?>
					</div>
					<div class="span2">
						<?php echo $form->labelEx($v, 'currentState'); ?>
						<?php
						echo $form->dropDownList($v, 'currentState', Workflow::getAllWorkflow(), array(
							'class' => 'input-small',
							'name' => 'WorkflowState[currentState][]'));
						?>
					</div>
					<div class="span2">
						<?php echo $form->labelEx($workflowStateModel, 'nextState'); ?>
						<?php
						echo $form->dropDownList($v, 'nextState', Workflow::getAllWorkflow(), array(
							'class' => 'input-small',
							'name' => 'WorkflowState[nextState][]'));
						?>
					</div>
					<div class="span2">
						<?php echo $form->labelEx($workflowStatusModel, 'workflowStatusId'); ?>
						<?php
						echo $form->dropDownList($v, 'workflowStatusId', WorkflowStatus::getAllWorkflowStatus(), array(
							'class' => 'input-small',
							'name' => 'WorkflowState[workflowStatusId][]'));
						?>
					</div>
					<div class="span2">
						<?php echo $form->labelEx($workflowStatusModel, 'requireConfirm'); ?>
						<?php
						echo $form->dropDownList($v, 'requireConfirm', array(
							"0" => "No Require",
							"1" => "Required"), array(
							'class' => 'input-small',
							'name' => 'WorkflowState[requireConfirm][]'));
						?>
					</div>
					<?php
					echo $form->hiddenField($workflowStateModel, 'ordered[]', array(
						'value' => $v->workflowStateId));
					?>
				</div>
			</div>
			<?php
		}
	}
	?>				
	<div class="well copy">
		<div class="row-fluid">
			<div class="span3">
				<?php echo $form->labelEx($workflowStateModel, 'workflowStateName'); ?>
				<?php
				echo $form->textField($workflowStateModel, 'workflowStateName[]', array(
					'class' => 'input-medium'));
				?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($workflowStateModel, 'currentState'); ?>
				<?php
				echo $form->dropDownList($workflowStateModel, 'currentState[]', Workflow::getAllWorkflow(), array(
					'class' => 'input-small'));
				?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($workflowStateModel, 'nextState'); ?>
				<?php
				echo $form->dropDownList($workflowStateModel, 'nextState[]', Workflow::getAllWorkflow(), array(
					'class' => 'input-small'));
				?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($workflowStatusModel, 'workflowStatusId'); ?>
				<?php
				echo $form->dropDownList($workflowStateModel, 'workflowStatusId[]', WorkflowStatus::getAllWorkflowStatus(), array(
					'class' => 'input-small'));
				?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($workflowStatusModel, 'requireConfirm'); ?>
				<?php
				echo $form->dropDownList($workflowStateModel, 'requireConfirm[]', array(
					"0" => "No Require",
					"1" => "Required"), array(
					'class' => 'input-small'));
				?>
			</div>
			<?php
			echo $form->hiddenField($workflowStateModel, 'ordered[]', array(
				'value' => ''));
			?>
		</div>
	</div>
</span>

<a id="copylink" href="#" rel=".copy" class="btn"><i class="icon-plus"></i></a>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class' => 'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->
