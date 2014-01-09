<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'FieldDialog',
	'options'=>array(
		'title'=>Yii::t('Field', 'New Field'),
		'autoOpen'=>true,
		'modal'=>'true',
		'width'=>'500',
		'height'=>'auto',
		'close'=>"js:function(e,ui){ jQuery('#FieldDialog').empty();}",
	),
));
echo $this->renderPartial('_documentTemplateFieldDialog', array(
	'model'=>$model));
?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
