<?php
// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('index'),
// $model->customer->customerName.' : '.$model->name,
// );
//
// $this->menu=array(
// array('label'=>'List QtechProject', 'url'=>array('index')),
// array('label'=>'Create QtechProject', 'url'=>array('create')),
// array('label'=>'Update QtechProject', 'url'=>array('update', 'id'=>$model->projectId)),
// array('label'=>'Delete QtechProject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->projectId),'confirm'=>'Are you sure you want to delete this item?')),
// array('label'=>'Manage QtechProject', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/project')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'View Qtech Project';
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/construction/default/update/id/' . $model->projectId); ?>"><i class="icon-edit icon-white"></i> Update</a>
	</div>
</div>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	//'htmlOptions'=>array('class'=>'table table-bordered table-striped table-condensed'),
	'attributes'=>array(
		array(
			'name'=>'productCatId',
			'value'=>$model->productCat->productCatName,
		),
		array(
			'name'=>'customerId',
			'value'=>$model->customer->customerFnTh,
		),
		'name',
		'detail',
		array(
			'name'=>'price',
			'value'=>number_format($model->price, 2),
		),
		array(
			'name'=>'engineerId',
			'value'=>$model->engineer->fnTh . ' ' . $model->engineer->lnTh,
		),
		array(
			'name'=>'customerId',
			'value'=>$model->customer->customerFnTh . ' ' . $model->customer->customerLnTh,
		),
		array(
			'name'=>'startDate',
			'type'=>'html',
			'value'=>'วันเริ่มงาน : ' . $this->dateThai($model->startDate, 1) . '<br />' .
			'วันเสร็จงาน : ' . $this->dateThai($this->dateWithDuration($model->startDate, $model->duration), 1) . '<br />' .
			'ระยะเวลา : ' . $model->duration . ' วัน',
		),
	),
));
?>
<div class="btn-toolbar">
	<a class="btn btn-primary" href="<?php
	echo Yii::app()->createUrl('/construction/process/create', array(
		'projectId'=>$model->projectId));
	?>"><i class="icon-plus icon-white"></i> Process</a>
</div>

<div>
	<?php
	foreach($model->process as $process):
		echo '<p><h4>' . $process->name .
		' <a class="btn btn-mini btn-primary" href="' . Yii::app()->createUrl('qtechProcessSub/create', array(
			'projectId'=>$model->projectId,
			'qtechProcessId'=>$process->processId)) . '"><i class="icon-plus icon-white"></i></a>' .
		' <a class="btn btn-mini btn-info" href="' . Yii::app()->createUrl('qtechProcess/update/' . $process->processId) . '"><i class="icon-edit icon-white"></i></a>' .
		'</h4></p>';

		echo '<ul class="nav nav-tabs nav-stacked">';
		foreach($process->processSub as $processSub)
		{
			echo '<li>' . CHtml::link($processSub->processSubName . ' : ' . $processSub->processSubImageCount . ' รูป วิศวกร ' . strtoupper($processSub->employee->username), Yii::app()->createUrl('/project/processSubImage', array(
					'id'=>$model->projectId,
					'processSubId'=>$processSub->processSubId))) . '</li>';
		}
		echo '</ul><hr />';
	endforeach;
	?>
</div>

<?php foreach($model->process as $process): ?>
	<div class="row">
		<div class="span3">
			<p>
				<a class="btn btn-mini btn-info" href="<?php
				echo Yii::app()->createUrl('process/create', array(
					'projectId'=>$model->projectId,
					'processId'=>$process->processId));
				?>">
					<i class="icon-edit icon-white"></i>
				</a>
			</p>
			<?php
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$process,
				'htmlOptions'=>array(
					'class'=>'table table-bordered table-striped table-condensed'),
				'attributes'=>array(
					array(
						'name'=>'name',
						'value'=>$process->name,
					),
					array(
						'name'=>'detail',
						'value'=>$process->detail,
					),
					'name',
					'detail',
					array(
						'name'=>'startDate',
						'type'=>'html',
						'value'=>'เริ่ม : ' . $this->dateThai($process->startDate, 1) . '<br />' .
						'เสร็จ : ' . $this->dateThai($this->dateWithDuration($process->startDate, $process->duration), 2) . '<br />' .
						'ระยะเวลา : ' . $process->duration . ' วัน',
					),
				),
			));
			?>
		</div>
	</div>
	<hr />
<?php endforeach; ?>