<h2>
	<?php
	switch($noticeType)
	{
		case "A":
			echo "ข่าวสารและกิจกรรม";
			break;
		case "B":
			$imgUrl = Yii::app()->baseUrl . "/images/ico/policy_icon.gif";
			break;
		case "C":
			$imgUrl = Yii::app()->baseUrl . "/images/ico/support_icon.png";
			break;
		default:
			break;
	}
	?>
</h2>

<?php
echo CHtml::link("<< Back", "", array(
	'onclick'=>"history.back()",
	'class'=>'btn btn-success'));
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>new CActiveDataProvider("Notice", array(
		'data'=>Notice::model()->findNoticeByNoticeTypeCode($noticeType)
		)),
	'itemView'=>'_notice',
	'itemsCssClass'=>'thumbnails',
	'id'=>'productView',
	'pager'=>array(
		'prevPageLabel'=>'&lt; Previous',
		'nextPageLabel'=>'Next &gt;',
	),
	'template'=>'{pager}{items}{pager}',
));
?>