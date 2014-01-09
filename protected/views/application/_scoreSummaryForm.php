<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
	//'htmlOptions'=>array('style'=>"overflow:scroll;height:450px;width:250px")
	));
?>
<?php
//HiddenFiled
echo $form->hiddenField($appInter[0], "applicationId");
?>
<div class="control-group">
	<label class="control-label"></label>
	<div class="controls">
		<?php
		echo "<h4>ผลการสัมภาษณ์ของกรรมการ</h4>";
		?></div>
</div>
<?php
if(count($appInter) > 0)
{
	echo "<table style=width:100%>";
	foreach($appInter as $item)
	{
		if($item->managerId != 1)
		{

			echo "<tr><td>";

			echo "<h4>" . $item->manager->username . "</h4>";
			echo "</td></tr>";
			if(isset($item->score))
			{
				echo "<tr><td>";
				echo "คะแนนรวม = " . $item->score . "</br>";
				echo "</td></tr>";
				echo "<tr><td><table class='table table-striped table-bordered table-condensed'>";
				foreach($item->appInterviewScore as $score)
				{
					echo "<tr><td>";
					echo $score->examQuestion->title . "</td>";
					echo "<td>คะแนน : ";
					echo $score->choiceValue;
					echo "</td></tr>";
				}
				echo "</table></td></tr>";
			}
			else
			{
				echo "ยังไม่ได้ประเมิณ<br>";
			}
		}
	}
	echo "</table>";
}
?>
<?php
if(!isset($appInter->score))
{
	?>
	<div class="control-group">
		<?php echo CHtml::submitButton('ส่งให้นาย'); ?>
	</div>
<?php } ?>
<?php $this->endWidget(); ?>