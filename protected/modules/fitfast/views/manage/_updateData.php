<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>$dialog,));
?>

<?php echo $form->labelEx($model, $field); ?>
<?php
echo $form->textField($model, $field, array(
	'class'=>'input-block-level',
	'id'=>$dialog . $field,
	'value'=>$value
));
?>

<?php
$dialog = '#' . $dialog;
echo CHtml::ajaxSubmitButton('บันทึก', Yii::app()->createUrl('fitAndFast/updateActual'), array(
	'type'=>'post',
	'data'=>'js:{actual:$("' . $dialog . $field . '").val(), fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '"}',
	'dataType'=>'json',
	'success'=>'js:function(data){
		if(data.status==true)
		{
			$("' . $span . '").html(data.actual);
			$("' . $dialog . '").dialog("close");
			$("' . $dialog . $field . '").val("");
		}
		else
		{
			alert("ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง");
		}
}',
	), array(
	'class'=>'btn btn-primary'));
?>

<?php $this->endWidget(); ?>