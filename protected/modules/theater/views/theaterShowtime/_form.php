<?php
/* @var $this TheaterShowtimeController */
/* @var $model TheaterShowtime */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'theater-showtime-form',
	'enableAjaxValidation'=>false,
	'method'=>'POST',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',
	),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>


<div class="row-fluid img-rounded" style="border: 1px solid;;background-color: black;color: white">
	<div class="span12">
		<?php if(isset($model->movie)): ?>
			<div class="row-fluid">
				<div class="span12" >
					<h2 style="margin-left: 20px">Movie</h2>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" style="text-align: center">
					<?php
					echo CHtml::image(Yii::app()->baseUrl . "/" . $model->movie->image, "", array(
						'height'=>"250px",
						'style'=>'margin-top:20px;margin-bottom:10px;border:5px solid'));
					?>
					<p><?php
						echo CHtml::link("แก้ไขหนัง", Yii::app()->createUrl("/theater/theaterMovie/update?id=" . $model->theaterMovieId . "&action=showtime"), array(
							'class'=>'btn btn-warning'));
						?>
					</p>
				</div>
				<div class="span7" >
					<div class="row-fluid">
						<div class="span12" style="text-align: center">
							<h2><?php echo $model->movie->title; ?></h2>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12" >
							<?php
							echo $model->movie->description;
							?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12" >
							<?php
							if(isset($model->movie->length) && !empty($model->movie->length))
								echo "ความยาวหนัง : " . $model->movie->length;
							?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12" >
							<?php ?>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>
	</div>
</div>
<div class="row-fluid " style="border: 1px solid;margin-top: 20px">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<h2 style="margin-left: 20px">รอบฉาย</h2>
			</div>
		</div>
		<?php if($this->action->id == "create"): ?>
			<div class="row-fluid">
				<div class="span12 " style="margin-left: 20px">
					<?php
					$this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'theater-showtime-grid',
						'dataProvider'=>$showtime->search(),
						//'filter'=>$model,
						'itemsCssClass'=>'table table-striped table-bordered',
						'columns'=>array(
							array(
								'class'=>'IndexColumn'),
							array(
								'name'=>'theaterId',
								'value'=>'$data->theater->title'
							),
							array(
								'name'=>'showDate',
								'value'=>'$this->grid->controller->dateThai($data->showDate,2,false)'
							),
							array(
								'name'=>'startTime',
								'value'=>'$data->theater->startTime'
							),
							array(
								'name'=>'endTime',
								'value'=>'$data->theater->endTime'
							),
							array(
								'name'=>'reserved',
								'type'=>'html',
								'value'=>'count($data->reserve)'
							),
							array(
								'name'=>'canceled',
								'type'=>'html',
								'value'=>'count($data->cancel)'
							),
							array(
								'name'=>'queue',
								'type'=>'html',
								'value'=>'count($data->queue)'
							),
							array(
								'class'=>'CButtonColumn',
								'template'=>'{viewReserve} {updateShowtime} {delete}',
								'buttons'=>array(
									'updateShowtime'=>array(
										'label'=>'<i class="icon-pencil"></i>',
										'url'=>'$this->grid->controller->createUrl("/theater/theaterShowtime/update", array("id"=>$data->primaryKey))',
//									'options'=>array(
//										'ajax'=>array(
////											'type'=>'POST',
//											'dataType'=>'JSON',
////											'data'=>'{id:1}',
//											'url'=>'js:$(this).attr("href")',
//											'success'=>'function(data){
//												$("#editRow").html("แก้ไขรอบฉาย");
//												$("#TheaterShowtime_theaterShowtimeId").val(data.theaterShowtimeId);
//
//												var showDate = data.showDate.split(" ");
//												$("#TheaterShowtime_showDate").val(showDate[0]);
//												$("#TheaterShowtime_theaterId").val(data.theaterId) ;
//
//												$("#showtimeForm").addClass("alert alert-success");
//												$("#submitBtn").hide();
//												$("#saveBtn").show();
//											}'
//										)
//									)
									),
									'viewReserve'=>array(
										'label'=>'ดูรายการ<br>',
										'url'=>'$this->grid->controller->createUrl("/theater/reserve/reservedList?theaterShowtimeId=".$data->theaterShowtimeId)',),
								)
							),
						),
						'htmlOptions'=>array(
							'style'=>'width:80%;'
						)
					));
					?>
				</div>
			</div>
		<?php endif; ?>
		<div class="row-fluid " id="showtimeForm" style="margin-bottom: 40px;width: 90%">
			<div class="span2"></div>
			<div class="span10">
				<div class="row-fluid">
					<div class="span12">
						<?php if($this->action->id == "create"): ?>
							<h4 id="editRow">สร้างรอบฉาย</h4>
						<?php else: ?>
							<h4 id="editRow">แก้ไขรอบฉาย</h4>
						<?php endif; ?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span10">
						<?php
						echo $form->errorSummary($model, '', '', array(
							'class'=>'alert alert-error'));
						echo $form->hiddenField($model, "theaterShowtimeId");
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span5">
						<?php
//						echo Select2::activeDropDownList($model, "theaterId", Theater::model()->findAllTheaterArray(), array(
//							'prompt'=>'-- เลือกโรงหนัง --',
//							'class'=>'input-block-level',
//							'select2Options'=>array(
//								'maximumSelectionSize'=>1,
//							),
//						));

						echo $form->dropdownList($model, "theaterId", Theater::model()->findAllTheaterArray(), array(
							'prompt'=>'-- เลือกโรงหนัง --'));
						?>
						<?php echo $form->error($model, 'theaterId'); ?>
					</div>
					<div class="span5">
						<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							//'name'=>'startDate',
							'model'=>$model,
							'attribute'=>'showDate',
							'language'=>'th',
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd'
							),
							'htmlOptions'=>array(
								'class'=>'input-block-level'),));
						?>
						<?php echo $form->error($model, 'showDate'); ?>
					</div>
					<div class="span2">
						<?php
						echo CHtml::submitButton($model->isNewRecord ? '+' : 'Save', array(
							'class'=>'btn btn-primary',
							'id'=>'submitBtn'));
						echo CHtml::link("Save", Yii::app()->createUrl("/theater/theaterShowtime/updateAjax/id/1"), array(
							'class'=>'btn btn-success hide',
							'id'=>'saveBtn'))
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php $this->endWidget(); ?>
