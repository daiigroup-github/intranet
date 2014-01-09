<?php
$this->breadcrumbs = array(
	'Projects'=>array(
		'index'),
	$model->projectId,
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/project/index/'); ?>"><i class="icon-arrow-left icon-white"></i>Back</a>
	</div>
</div>
<h1>โครงการ :  <?php echo $model->projectName; ?></h1>
<h3>ลูกค้า : <?php
	if(isset($model->customer))
	{
		echo $model->customer->customerFnTh . " " . $model->customer->customerLnTh;
	}
	else
	{
		echo " - ";
	}
	?></h3>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'productCatId',
		'productValue',
		//'projectName',
		'projectDetail',
		'projectPrice',
		'projectImageName',
		'projectAddress',
		'customerId',
		'startDate',
		'endDate',
		'latitude',
		'longitude',
		'branchValue',
		'status',
	),
));

if(isset($process))
{
	foreach($process as $item)
	{
		echo "<h3>Process Name : $item->processName</h3>";
		$sub = Process::model()->findAll("parentId =:parentId", array(
			":parentId"=>$item->processId));
		if(count($sub) == 0)
		{
			//Use by table processImage
			$processImage = ProcessImage::model()->findAll("processId = :processId", array(
				":processId"=>$item->processId));
			//Use By table DocumentItem field documentItemName = processId by documentType = Engineer Report(ERE)
			// $processImage = DocumentItem::model()->xxxxxx ---> result item of document of process in project create by IPHONE from p'TUMM
			if(isset($processImage))
			{
				foreach($processImage as $image)
				{
					$imageName = $image->processImageName;
					echo "<div class='row-fluid alert alert-info'><div class='span12' style='text-align:center'>";
					echo "<p><a class='fancyFrame' Title='$imageName' href='$imageName'><img src='$imageName' width='200px' alt='' /></a></p>";
					echo "<p>$image->processImageDetail</p>";
					/* if($image->status == 1)
					  {
					  echo "<a class='btn btn-success' href=".Yii::app()->createUrl('/project/approveImage/'.$image->processImageId)."><i class='icon-ok icon-white'></i>อนุมัติ</a>";
					  echo "<a class='btn btn-danger' href=".Yii::app()->createUrl('/project/rejectImage/'.$image->processImageId)."><i class='icon-remove icon-white'></i>ไม่อนุมัติ</a>";
					  } */
					echo "<p></p>";
					echo "</div></div>";
				}
			}
			else
			{
				echo "-";
			}
		}
		else
		{
			$subprocess = Process::model()->getAllSubProcessByProjectIdAndProcessId($item->projectId, $item->processId);
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'process-grid',
				'dataProvider'=>$subprocess,
				//'filter'=>$model,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed',
				'columns'=>array(
					array(
						'name'=>'processName',
						'value'=>'isset($data->processName)?CHtml::encode($data->processName):"-"',
					),
					/* array(
					  'name'=>'processName',
					  'value'=>'isset($data->process)?CHtml::encode($data->processName):"-"',
					  ), */
					//'createDateTime',
					//'productCatId',
					//'productValue',
					array(
						'class'=>'CButtonColumn',
					),
				),
			));
		}
	}
}
?>

