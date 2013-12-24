<?php /* <div class="view">

  <b><?php echo CHtml::encode($data->getAttributeLabel('mileageId')); ?>:</b>
  <?php echo CHtml::link(CHtml::encode($data->mileageId), array('view', 'id'=>$data->mileageId)); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
  <?php echo CHtml::encode($data->status); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('createDate')); ?>:</b>
  <?php echo CHtml::encode($data->createDate); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('createTime')); ?>:</b>
  <?php echo CHtml::encode($data->createTime); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('captureTime')); ?>:</b>
  <?php echo CHtml::encode($data->captureTime); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('mileage')); ?>:</b>
  <?php echo CHtml::encode($data->mileage); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('mileageDiff')); ?>:</b>
  <?php echo CHtml::encode($data->mileageDiff); ?>
  <br />


  <b><?php echo CHtml::encode($data->getAttributeLabel('mileageDetail')); ?>:</b>
  <?php echo CHtml::encode($data->mileageDetail); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('mileageImage')); ?>:</b>
  <?php echo CHtml::encode($data->mileageImage); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
  <?php echo CHtml::encode($data->latitude); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
  <?php echo CHtml::encode($data->longitude); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
  <?php echo CHtml::encode($data->employeeId); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('branchId')); ?>:</b>
  <?php echo CHtml::encode($data->branchId); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('qtechProjectId')); ?>:</b>
  <?php echo CHtml::encode($data->qtechProjectId); ?>
  <br />



  </div> */ ?>

<div class="row-fluid">
	<div class="well">
		<div class="row-fluid">
			<div class="span6">
				Date Time : <?php echo $data->createDate; ?><br />
				Mileage : <?php echo $data->mileage; ?><br />
				Mileage Diff : <?php echo $data->mileageDiff; ?><br />
				Mileage Detail : <?php echo $data->mileageDetail; ?><br />
				Employee ID : <?php echo $data->employeeId; ?><br />
			</div>
		</div>

		<p>

		</p>
	</div>
</div>