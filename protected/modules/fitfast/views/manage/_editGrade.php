<div class = "btn-group">
	<?php
	$sBtnClass = '';

	if($grade == 'S' || $grade == 's')
	{
		$sBtnClass = 'btn-success';
	}

	echo CHtml::ajaxLink('s', Yii::app()->createUrl('fitAndFast/updateGrade'), array(
		'type'=>'post',
		'data'=>'js:{grade:"s", fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '"}',
		'dataType'=>'json',
		'success'=>'js:function(data){
			if(data.status == true)
			{
				if(data.grade=="s")
				{
					$("#' . $sBtnId . '").addClass("btn-success");
					$("#' . $fBtnId . '").removeClass("btn-danger");
				}
				else
					$("#' . $sBtnId . '").removeClass("btn-success");
			}
			else
			{
				alert("ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่");
			}
		}',
		), array(
		'class'=>'btn btn-mini ' . $sBtnClass,
		'id'=>$sBtnId,
		'confirm'=>'confirm!!',
	));

	echo CHtml::ajaxLink('S', Yii::app()->createUrl('fitAndFast/updateGrade'), array(
		'type'=>'post',
		'data'=>'js:{grade:"S", fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '"}',
		'dataType'=>'json',
		'success'=>'js:function(data){
			if(data.status == true)
			{
				if(data.grade=="S")
				{
					$("#' . $sBtnId . '").addClass("btn-success");
					$("#' . $fBtnId . '").removeClass("btn-danger");
				}
				else
					$("#' . $sBtnId . '").removeClass("btn-success");
			}
			else
			{
				alert("ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่");
			}
		}',
		), array(
		'class'=>'btn btn-mini ' . $sBtnClass,
		'id'=>$sBtnId,
		'confirm'=>'confirm!!',
	));

	$fBtnClass = '';

	if($grade == 'F')
	{
		$fBtnClass = 'btn-danger';
	}

	echo CHtml::ajaxLink('F', Yii::app()->createUrl('fitAndFast/updateGrade'), array(
		'type'=>'post',
		'data'=>'js:{grade:"F", fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '"}',
		'dataType'=>'json',
		'success'=>'js:function(data){
			if(data.status == true)
			{
				if(data.grade=="F")
				{
					$("#' . $fBtnId . '").addClass("btn-danger");
					$("#' . $sBtnId . '").removeClass("btn-success");
				}
				else
					$("#' . $fBtnId . '").removeClass("btn-danger");
			}
			else
			{
				alert("ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่");
			}
		}',
		), array(
		'class'=>'btn btn-mini ' . $fBtnClass,
		'id'=>$fBtnId,
		'confirm'=>'confirm!!',
	));
	?>
</div>