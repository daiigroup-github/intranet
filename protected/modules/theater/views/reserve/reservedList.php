<?php
/* @var $this TheaterShowtimeController */
/* @var $model TheaterShowtime */

$this->breadcrumbs = array(
	'Theater Showtimes'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List TheaterShowtime',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Create TheaterShowtime',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#theater-showtime-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="module">
	<div class="module-head">
		<h3>รายการจอง หนังเรื่อง <?php echo $model->showtime->movie->title; ?></h3>
		<p style="text-align: center"><?php
			echo CHtml::image(Yii::app()->baseUrl . $model->showtime->movie->image, "", array(
				"style"=>'width:250px'));
			?></p>
		<h4>รอบเวลา : <?php echo $this->dateThai($model->showtime->showDate, 2, false); ?></h4>
	</div>
	<div class="module-option clearfix">
		<div class="pull-left">
			<?php
//			$this->renderPartial('_search', array(
//				'model'=>$model,
//			));
			?>
		</div>
		<div class="btn-group pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array(
//				'class'=>'btn btn-small btn-primary'));
			?>
		</div>
	</div>
	<div class="module-body">
		<hr>
		<h4 class="alert alert-success">รายการจอง(Reserved)</h4>
		<?php
		$model->status = 1;
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'theater-showtime-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array(
					'class'=>'IndexColumn'),
				'reserveCode',
				array(
					'name'=>'employeeId',
					'type'=>'html',
					'value'=>'"<b>(".$data->employee->username.")</b>&nbsp;&nbsp;".$data->employee->fnTh." ".$data->employee->lnTh',
				),
//				array(
//					'name'=>'status',
//					'value'=>'getStatusText($data->status)'
//				),
//				array(
//					'name'=>'cancelRemark',
//					'type'=>'html',
//					'value'=>'(isset($data->cancelRemark) && !empty($data->cancelRemark))?$data->cancelRemark:"-" '
//				)
//				array(
//					'class'=>'CButtonColumn',
//				),
			),
		));
		?>

		<h4 class="alert alert-info">รายการจองแต่ที่นั่งเต็ม(Queue)</h4>
		<?php
		$model->status = 2;
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'theater-showtime-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array(
					'class'=>'IndexColumn'),
				'reserveCode',
				array(
					'name'=>'employeeId',
					'type'=>'html',
					'value'=>'"<b>(".$data->employee->username.")</b>&nbsp;&nbsp;".$data->employee->fnTh." ".$data->employee->lnTh',
				),
//				array(
//					'name'=>'status',
//					'value'=>'getStatusText($data->status)'
//				),
//				array(
//					'name'=>'cancelRemark',
//					'type'=>'html',
//					'value'=>'(isset($data->cancelRemark) && !empty($data->cancelRemark))?$data->cancelRemark:"-" '
//				)
//				array(
//					'class'=>'CButtonColumn',
//				),
			),
		));
		?>

		<h4 class="alert alert-danger">รายการยกเลิกการจอง (Cancelled)</h4>
		<?php
		$model->status = 0;
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'theater-showtime-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array(
					'class'=>'IndexColumn'),
				'reserveCode',
				array(
					'name'=>'employeeId',
					'type'=>'html',
					'value'=>'"<b>(".$data->employee->username.")</b>&nbsp;&nbsp;".$data->employee->fnTh." ".$data->employee->lnTh',
				),
//				array(
//					'name'=>'status',
//					'value'=>'getStatusText($data->status)'
//				),
				array(
					'name'=>'cancelRemark',
					'type'=>'html',
					'value'=>'(isset($data->cancelRemark) && !empty($data->cancelRemark))?$data->cancelRemark:"-" '
				)
//				array(
//					'class'=>'CButtonColumn',
//				),
			),
		));
		?>

	</div>
	<div class="form-actions">
		<?php
		echo CHtml::link("กลับไปหน้าจัดการ รอบฉาย", Yii::app()->createUrl("theater/theaterShowtime/create?theaterMovieId=" . $model->showtime->theaterMovieId), array(
			'class'=>'btn btn-success'));
		?>
	</div>
</div>

<?php

function getStatusText($status)
{
	switch($status)
	{
		case 1:
			return "จองแล้ว";
			break;
		case 0:
			return "ยกเลิก";
			break;
		case 2:
			return "จองแต่เต็ม";
			break;
		default:
			break;
	}
}
?>