<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('memo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Memo ถาดเข้า</h1>


<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/memo/create'); ?>"><i class="icon-plus"></i><i class="icon-tags"></i></a>
	</div>
</div>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'memo-grid',
	'dataProvider'=>$model->searchInbox(Yii::app()->user->id),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		'subject',
		/*
		  array(
		  'name' => 'detail',
		  'type' => 'html',
		  'htmlOptions' =>array('style'=>'text-align:left'),
		  'value' => 'isset($data->detail)?$data->detail:"-"',

		  ), */
		array(
			'name'=>'createBy',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:20%'),
			'value'=>'CHtml::encode(isset($data->createBy)?$data->employee->fnTh." ".$data->employee->lnTh." (".$data->employee->username.")":"-")',
		),
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:17%;'),
			'value'=>'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		array(
			'name'=>'สถานะ',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:10%'),
			'value'=>array(
				$this,
				'checkIsRead'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} ',
		),
	),
));
?>

<?php

function checkRead($memoId)
{
	return $this->checkIsRead($memoId);
}
?>
