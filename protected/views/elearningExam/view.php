<div class="alert">
	<h3>ระยะเวลาการสอบ 30 นาที</h3>
	<p>
		หลังจากทำเสร็จให้คลิกที่ปุ่ม ส่งคำตอบ ด่านล่าง
	</p>
</div>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'exam-form',
	'enableAjaxValidation' => false,
));

$i = 1;
foreach ($questionArray as $question):
?>
<h4><?php echo $i. ' ' . $question['title'];?></h4>

<?php if(!empty($question['description'])):?>
<p>
	<?php echo $question['description'];?>
</p>
<?php endif;?>

<?php foreach ($question['choice'] as $choice):?>
	<label class="radio">
		<input type="radio" name="answer[<?php echo $question['questionId'];?>]" value="<?php echo $choice['choiceId'];?>">
		<?php echo $choice['title'];?>
	</label>	
<?php endforeach;?>

<hr />
<?php $i++;?>
<?php endforeach;?>

<div class="form-actions">
	<?php echo CHtml::button('ส่งคำตอบ', array('onclick'=>'submitExam()', 'class'=>'btn btn-primary'));?>
</div>

<?php $this->endWidget(); ?>

<script>
	function submitExam()
	{
		$.ajax({
			type : 'POST',
			url : '<?php echo Yii::app()->createUrl("elearningExam/submitExam/$elearningExamId");?>',
			data : $('#exam-form').serialize(),
			dataType : 'json',
			success : function(res){
				alert('คะแนน : ' + res.point);
				window.location.href = "<?php echo Yii::app()->createUrl('home');?>";
			},
		});
	}
</script>