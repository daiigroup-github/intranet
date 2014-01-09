<script type="text/javascript">
// here is the magic
	function addStockDetail()
	{
<?php
echo CHtml::ajax(array(
	'url'=>array(
		'stock/index'),
	'data'=>"js:$(this).serialize()",
	'type'=>'post',
	'dataType'=>'json',
	'success'=>"function(data)
            {
                if (data.status == 'failure')
                {alert('1111111');
                    $('#cru-dialog div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#cru-dialog div.divForForm form').submit(addClassroom);
                }
                else
                {  alert('2222');
                    $('#cru-dialog div.divForForm').html(data.div);
                    setTimeout(\"$('#cru-dialog').dialog('close') \",3000);
                }

            } ",
))
?>;
		return false;
	}
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'stock-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal')
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class'=>'alert alert-error'));
$form->error($model, 'stockDetailId');
$form->error($model, 'companyId');
$form->error($model, 'stockQuantity');
$form->error($model, 'stockUnitPrice');
$form->error($model, 'status');
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'stockDetailId'); ?></label>
		<div class="controls">
			<?php echo ZHtml::stockDetailDropDownList($model, 'stockDetailId'); ?>
			<?php
			echo CHtml::link('Create stock detail', "", // the link for open the dialog
				array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{addStockDetail(); $('#cru-dialog').dialog('open');}"
				)
			);
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'companyId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'companyId', Company::getAllCompany(), array(
				'class'=>'input-small'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'stockQuantity'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'stockQuantity', array(
				'size'=>15,
				'maxlength'=>11));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'stockUnitPrice'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'stockUnitPrice', array(
				'size'=>15,
				'maxlength'=>15));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'status'); ?></label>
		<div class="controls">
			<?php echo $form->checkBox($model, 'status'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'cru-dialog',
	'options'=>array(
		'title'=>'Stock Detail',
		'autoOpen'=>false,
		'modal'=>true,
		'width'=>750,
		'height'=>600,
	//'buttons' => array('AA','')
	),
));
?>
<div class="divForForm"></div>
<?php $this->endWidget(); ?>
<!-- form -->
