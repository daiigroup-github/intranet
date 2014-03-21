<?php
/**
 * require
 * $fitAndFastId
 * $field
 *
 * $type = 1 (performance)
 *  s, S, F
 *
 * $typs = 2 (implement)
 *  S, SS, F
 */
$sBtnId = 's' . $btnId;
$SBtnId = 'S' . $btnId;
$fBtnId = 'f' . $btnId;
?>
<div class = "btn-group">
	<?php
	$sBtnClass = '';

	if($grade == 's')
	{
		$sBtnClass = 'btn-success';
	}

	echo CHtml::ajaxLink('s', $this->createUrl('default/updateGrade'), array(
		'type'=>'post',
		'data'=>'js:{grade:"s", fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '", ' . 'type:"' . $type . '"}',
		'dataType'=>'json',
		'success'=>'js:function(data){
			if(data.status == true)
			{
				if(data.grade=="s")
				{
					$("#' . $sBtnId . '").addClass("btn-success");
					$("#' . $SBtnId . '").removeClass("btn-success");
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

	$SBtnClass = '';

	if($grade == 'S')
	{
		$SBtnClass = 'btn-success';
	}

	echo CHtml::ajaxLink('S', $this->createUrl('default/updateGrade'), array(
		'type'=>'post',
		'data'=>'js:{grade:"S", fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '", ' . 'type:"' . $type . '"}',
		'dataType'=>'json',
		'success'=>'js:function(data){
			if(data.status == true)
			{
				if(data.grade=="S")
				{
					$("#' . $SBtnId . '").addClass("btn-success");
					$("#' . $sBtnId . '").removeClass("btn-success");
					$("#' . $fBtnId . '").removeClass("btn-danger");
				}
				else
					$("#' . $SBtnId . '").removeClass("btn-success");
			}
			else
			{
				alert("ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่");
			}
		}',
		), array(
		'class'=>'btn btn-mini ' . $SBtnClass,
		'id'=>$SBtnId,
		'confirm'=>'confirm!!',
	));

	$fBtnClass = '';

	if($grade == 'F')
	{
		$fBtnClass = 'btn-danger';
	}

	echo CHtml::ajaxLink('F', $this->createUrl('default/updateGrade'), array(
		'type'=>'post',
		'data'=>'js:{grade:"F", fitAndFastId:' . $fitAndFastId . ', field:"' . $field . '", ' . 'type:"' . $type . '"}',
		'dataType'=>'json',
		'success'=>'js:function(data){
			if(data.status == true)
			{
				if(data.grade=="F")
				{
					$("#' . $SBtnId . '").removeClass("btn-success");
					$("#' . $sBtnId . '").removeClass("btn-success");
					$("#' . $fBtnId . '").addClass("btn-danger");
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