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
		<?php
		$emp = Employee::model()->findByPk(Yii::app()->user->id);
		?>
		<h3>รายการจอง หนังของ คุณ <?php echo $emp->fnTh . " " . $emp->lnTh; ?></h3>
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
	<style>
		.oldShow
		{
			text-decoration:line-through;
		}
	</style>
	<div class="module-body">
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'theater-showtime-grid',
			'dataProvider'=>$model->findAllMyReserved(),
			//'filter'=>$model,
			'itemsCssClass'=>'table  table-bordered',
			'rowCssClassExpression'=>'($data->noDateDiff >=1)?"alert alert-danger oldShow":"alert alert-success"',
			'columns'=>array(
				array(
					'class'=>'IndexColumn'),
				array(
					'name'=>'image',
					'type'=>'html',
					'value'=>'isset($data->showtime->movie)?CHtml::image(Yii::app()->baseUrl.$data->showtime->movie->image,"",array("style"=>"height:150px")):"-" '
				),
				array(
					'name'=>'title',
					'value'=>'isset($data->showtime->movie)?$data->showtime->movie->title:"-	"'
				),
				array(
					'name'=>'showDate',
					'value'=>'($data->showtime)?Yii::app()->getController()->dateThai($data->showtime->showDate,2,false):"-"'
				),
				'reserveCode',
				array(
					'name'=>'employeeId',
					'type'=>'html',
					'value'=>'"<b>(".$data->employee->username.")</b>&nbsp;&nbsp;".$data->employee->fnTh." ".$data->employee->lnTh',
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{cancel}',
					'buttons'=>array(
						'cancel'=>array(
							'label'=>'<u>ยกเลิกการจอง</u>',
							'url'=>'$this->grid->controller->createUrl("/theater/reserve/cancel", array("id"=>$data->primaryKey))',
							'options'=>array(
								'onclick'=>'return confirm("คุณต้องการยกเลิกรายการจองนี้หรือไม่ ?")'
							),
							'visible'=>'($data->noDateDiff >= 3)?False:True'
						)
					)
				),
			),
		));
		?>

	</div>
	<div class="form-actions">
		<?php
		echo CHtml::link("กลับไปหน้ารอบฉาย", Yii::app()->createUrl("theater"), array(
			'class'=>'btn btn-success'));
		?>
	</div>
</div>