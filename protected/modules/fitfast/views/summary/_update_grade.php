<?php
/**
 * require
 * $fitAndFastId
 * $field
 *
 */
?>
<div class = "btn-group">
    <?php
    $SBtnClass = '';

    if($fitfastTarget->grade > 0)
    {
        $SBtnClass = 'btn-success';
    }

    echo CHtml::ajaxLink('S', $this->createUrl('default/updateGrade'), array(
        'type'=>'post',
        'data'=>'js:{grade:1, fitfastTargetId:' . $fitfastTarget->fitfastTargetId . '}',
        'dataType'=>'json',
        /*
		'success'=>'js:function(data){
            //
		}',
        */
    ), array(
        'class'=>'btn btn-mini ' . $SBtnClass,
        'id'=>$fitfastTarget->fitfastTargetId,
        'confirm'=>'confirm!!',
    ));

    $fBtnClass = '';

    if($fitfastTarget->grade < 0)
    {
        $fBtnClass = 'btn-danger';
    }

    echo CHtml::ajaxLink('F', $this->createUrl('default/updateGrade'), array(
        'type'=>'post',
        'data'=>'js:{grade:-1, fitAndFastId:' . $fitfastTarget->fitfastTargetId . '}',
        'dataType'=>'json',
        /*
		'success'=>'js:function(data){
            //
		}',
        */
    ), array(
        'class'=>'btn btn-mini ' . $fBtnClass,
        'id'=>$fitfastTarget->fitfastTargetId,
        'confirm'=>'confirm!!',
    ));
    ?>
</div>
