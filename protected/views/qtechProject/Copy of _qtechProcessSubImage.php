<div class="view">
	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('qtechProjectId')); ?>:</b>
	  <?php echo CHtml::link(CHtml::encode($data->qtechProjectId), array('view', 'id'=>$data->qtechProjectId)); ?>
	  <br />
	 */ ?>
	<div class="row">
		<!-- Image -->
		<!--
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/project/<?php echo $data->imageName; ?>" />
		-->
		<img src="http://daiichireport.dcorp.co.th/images/project/<?php echo $data->imageName; ?>" style="width:300px;height:200px;" />
		<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $data->latitude; ?>,<?php echo $data->longitude; ?>&zoom=15&size=300x200&sensor=true&markers=color:blue%7Clabel:S%7C<?php echo $data->latitude; ?>,<?php echo $data->longitude; ?>" style="width:300px;height:200px;" />
	</div>

	<div class="row">
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$data,
			'attributes'=>array(
				array(
					'name'=>'Project',
					'value'=>CHtml::encode($data->project->customer->customerName . ' : ' . $data->project->projectName),
				),
				array(
					'name'=>'Detail',
					'value'=>CHtml::encode($data->imageDetail),
				),
				array(
					'name'=>'Labour(s)',
					'value'=>CHtml::encode($data->labour),
				),
				array(
					'name'=>'Data Time',
					'value'=>CHtml::encode($data->imageDate . ' ' . $data->imageTime),
				),
			),
		));
		?>
	</div>
</div>