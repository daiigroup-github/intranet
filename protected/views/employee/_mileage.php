<?php
if($data->projectId == 0 && $data->branchId == 0)
{
	$place = 'Home';
}
else
{
	$place = '-';
	if($data->project)
	{
		$place = $data->project->projectName . ' (' . $data->project->customer->customerName . ')';
	}

	if($data->branch)
	{
		$place = $data->branch->branchName;
	}
}
?>

<div class="row-fluid">
	<div class="well">
		<div class="row-fluid">
			<div class="span6">
				<img src="http://daiichireport.dcorp.co.th/images/mileage/<?php echo $data->mileageImage; ?>" style="width:404px;height:269px;" />
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
						'name'=>'Place',
						'value'=>$place,
					),
					array(
						'name'=>'Mileage',
						'value'=>$data->mileage,
					),
					array(
						'name'=>'Mileage Diff',
						'value'=>$data->mileageDiff,
					),
					array(
						'name'=>'Mileage Detail',
						'value'=>$data->mileageDetail,
					),
					array(
						'name'=>'Data Time',
						'value'=>$data->createDate . ' ' . $data->createTime,
					),
				),
			));
			?>
		</p>
	</div>
</div>
