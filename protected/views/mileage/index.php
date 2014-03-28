<?php
$this->breadcrumb = '<li>' . CHtml::link('Employee', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Mileage</li>';
$this->pageHeader = 'Mileage :';

/*
  Yii::app()->clientScript->registerScript('search', "
  $('.search-form form').submit(function(){
  $.fn.yiiGridView.update('mileage-summary', {
  data: $(this).serialize()
  });
  return false;
  });
  ");
 */
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui.min.js"></script>

<script>
	$(document).ready(function() {
		$("#Mileage_startDate").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true
		});
		$("#Mileage_endDate").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true
		});
	});
</script>

<div class="search-form" style="display:block;">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
if (isset($models))
	foreach ($models as $m)
	{
		$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'mileage-grid',
			'dataProvider' => Mileage::mileageWithEmployeeIdAndDate($m->employeeId, $m->createDate),
			'itemsCssClass' => 'table table-striped table-bordered table-condensed',
			'summaryText' => $m->createDate . ' | Sum : ' . $m->sumMileageDiff,
			'columns' => array(
				array(
					'name' => 'Date Time',
					'value' => 'CHtml::encode($data->createTime)',
				),
				array(
					'name' => 'mileage',
					'value' => 'CHtml::encode(number_format($data->mileage))',
				),
				array(
					'name' => 'Diff',
					'value' => 'CHtml::encode($data->mileageDiff)',
				),
				array(
					'name' => 'Detail',
					'value' => 'CHtml::encode($data->mileageDetail)',
				),
				array(
					'name' => 'Image',
					'type' => 'raw',
					'value' => 'CHtml::image("http://daiichireport.dcorp.co.th/images/mileage/".$data->mileageImage, $data->mileageDetail, array("style"=>"width:200px;height:150px;"))',
				),
				array(
					'name' => 'map',
					'type' => 'raw',
					'value' => 'CHtml::image("http://maps.googleapis.com/maps/api/staticmap?center=".$data->latitude.", ".$data->longitude."&zoom=15&size=150x150&sensor=true&markers=color:blue%7Clabel:S%7C".$data->latitude.", ".$data->longitude)',
				),
				array(
					'class' => 'CButtonColumn',
				),
			),
		));
	}
?>