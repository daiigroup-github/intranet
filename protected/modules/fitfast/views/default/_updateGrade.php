<?php
/**
 * require
 * $fitAndFastId
 * $field
 *
 */
$SBtnId = 's' . $btnId;
$SBtnId = 'S' . $btnId;
$SSBtnId = 'SS' . $btnId;
$fBtnId = 'f' . $btnId;
?>
<div class = "btn-group">
	<?php
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
				//$("#' . $SBtnId . '").parent().parent().html(data.grade);
				window.location.reload();
				if(data.grade=="S")
				{
					$("#' . $SBtnId . '").addClass("btn-success");
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
				//$(".btn-group").html(data.grade);
				window.location.reload();
				if(data.grade=="F")
				{
					$("#' . $fBtnId . '").addClass("btn-danger");
					$("#' . $SBtnId . '").removeClass("btn-success");
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
