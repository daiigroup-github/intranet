<?php
// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('index'),
// $model->customer->customerName.' : '.$model->projectName,
// );
// 
// $this->menu=array(
// array('label'=>'List QtechProject', 'url'=>array('index')),
// array('label'=>'Create QtechProject', 'url'=>array('create')),
// array('label'=>'Update QtechProject', 'url'=>array('update', 'id'=>$model->qtechProjectId)),
// array('label'=>'Delete QtechProject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->qtechProjectId),'confirm'=>'Are you sure you want to delete this item?')),
// array('label'=>'Manage QtechProject', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/qtechProject')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'View Qtech Project';
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/qtechProject/update/' . $model->qtechProjectId); ?>"><i class="icon-edit icon-white"></i> Update</a>
	</div>
</div>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	//'htmlOptions'=>array('class'=>'table table-bordered table-striped table-condensed'),
	'attributes' => array(
		array(
			'name' => 'productCatId',
			'value' => $model->productCat->productCatName,
		),
		array(
			'name' => 'customerId',
			'value' => $model->customer->customerFnTh,
		),
		'projectName',
		'projectDetail',
		'projectPrice',
	),
));
?>
<div class="btn-toolbar">
	<a class="btn btn-primary" href="<?php
	echo Yii::app()->createUrl('/qtechProcess/create', array(
		'qtechProjectId' => $model->qtechProjectId));
	?>"><i class="icon-plus icon-white"></i> Process</a>	
</div>

<p>
	<?php
	foreach ($model->process as $process)
	{
		echo '<p><h4>' . $process->processName .
		' <a class="btn btn-mini btn-primary" href="' . Yii::app()->createUrl('qtechProcessSub/create', array(
			'qtechProjectId' => $model->qtechProjectId,
			'qtechProcessId' => $process->qtechProcessId)) . '"><i class="icon-plus icon-white"></i></a>' .
		' <a class="btn btn-mini btn-info" href="' . Yii::app()->createUrl('qtechProcess/update/' . $process->qtechProcessId) . '"><i class="icon-edit icon-white"></i></a>' .
		'</h4></p>';

		echo '<ul class="nav nav-tabs nav-stacked">';
		foreach ($process->processSub as $processSub)
		{
			echo '<li>' . CHtml::link($processSub->processSubName . ' : ' . $processSub->processSubImageCount . ' รูป วิศวกร ' . strtoupper($processSub->employee->username), Yii::app()->createUrl('/qtechProject/processSubImage', array(
					'id' => $model->qtechProjectId,
					'processSubId' => $processSub->processSubId))) . '</li>';
		}
		echo '</ul><hr />';
	}
	?>
</p>