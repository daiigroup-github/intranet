<div class="row-fluid">
	<div class="well">
		<div class="row-fluid">
			<div class="span6">
				<img src="http://daiichireport.dcorp.co.th/images/project/<?php echo $data->imageName; ?>" style="width:404px;height:269px;" />
			</div>
			<div class="span6">
				<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $data->latitude; ?>,<?php echo $data->longitude; ?>&zoom=15&size=300x200&sensor=true&markers=color:blue%7Clabel:S%7C<?php echo $data->latitude; ?>,<?php echo $data->longitude; ?>" style="width:404px;height:269px;" />
			</div>
		</div>

		<p>
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
		</p>
	</div>
</div>