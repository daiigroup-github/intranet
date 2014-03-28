<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'exam-title-form',
	//'enableAjaxValidation' => true,
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,),
	'htmlOptions' => array(
		'class' => 'form-horizontal'),
	));
?>

<p class="note">
	Fields with <span class="required">*</span> are required.
	<?php //echo $form->errorSummary($model, '', '', array('class' => 'alert alert-error'));  ?>
</p>	

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'title'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'title', array(
				'size' => 60,
				'maxlength' => 200
			));
			?>
			<?php echo $form->error($model, 'title'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'description'); ?></label>
		<div class="controls">
			<?php echo $form->textArea($model, 'description');
			?>
		</div>
	</div>

	<hr />

	<!-- Question -->
	<section id="question">
		<?php //Append question here  ?>
	</section>

	<?php
	echo CHtml::link('เพิ่มคำถาม', '#', array(
		'onclick' => 'showQuestionDialog();',));
	?>
	<input type="hidden" value="1" id="firstShow" />
	<input type="hidden" value="1" id="qId" />

</fieldset>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class' => 'btn btn-primary'));
	?>
</div>
<input type="hidden" name="questionOrder" value="1" />
<?php $this->endWidget(); ?>
<!-- form -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id' => 'addQuestionDialog',
	// additional javascript options for the dialog plugin
	'options' => array(
		'title' => 'Dialog box 1',
		'autoOpen' => false,
		'modal' => false,
		'height' => 550,
		'width' => 400,
		'buttons' => array(
			'Add Question' => 'js:addQuestion',
			'Cancel' => 'js:function(){ $(this).dialog("close");}',
		),
	),
));

$this->widget('ext.jqrelcopy.JQRelcopy', array(
	'id' => 'copylink',
	'removeText' => '<i class="icon-minus icon-white"></i>',
	'removeHtmlOptions' => array(
		'style' => 'color:red',
		'class' => 'btn btn-danger'
	),
	'options' => array(
		'copyClass' => 'newcopy',
		'clearInputs' => true,
		'excludeSelector' => '.skipcopy',
	)
));

echo '<div id="addQuestionForm"></div>';

echo '<a class="btn btn-primary" rel=".choice" id="copylink" style="display:none;"><i class="icon-plus icon-white"></i></a>';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<script type="text/javascript">
	function showQuestionDialog()
	{
		$("#addQuestionForm").html('');
<?php
echo CHtml::ajax(array(
	'url' => array(
		'exam/addQuestion'),
	'data' => 'js:{firstShow:$("#firstShow").val(), qId:$("#qId").val()}',
	'dataType' => 'json',
	'type' => 'POST',
	'success' => 'function(data){
			$("#addQuestionForm").html(data.div);
			$("#addQuestionDialog").dialog("open");
		}',
));
?>

		$("#firstShow").val(0);

		return false;
	}

	function addQuestion()
	{
<?php
echo CHtml::ajax(array(
	'url' => array(
		'exam/addQuestion'),
	'data' => 'js:$("#exam-question-form").serialize()',
	'dataType' => 'json',
	'type' => 'POST',
	'success' => 'function(data){
			finishedAddQuestion(data);
			return false;
		}',
	'error' => 'js:function(){alert("error");}',
));
?>
	}

	function finishedAddQuestion(data)
	{
		//alert(data.result);
		if (data.result == true)
		{
			$("#qId").val(parseInt($("#qId").val()) + 1);
			$("#question").append(data.div);
			$("#addQuestionDialog").dialog("close");
		}
		else
		{
			alert(data.errorMsg);
		}
	}
</script>