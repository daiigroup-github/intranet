<?php
/**
 * require
 * $fitAndFastId
 * $field
 *
 */
?>
<div class="btn-group">
    <?php
    foreach ($fitfastTarget->gradeArray() as $k => $v) {
        $btnClass = '';
        $k = ($k==0) ? 0.5 : $k;

        if($fitfastTarget->fitfast->type == Fitfast::FITFAST_TYPE_PERFORMANCE)
        {
            if($k == $fitfastTarget::GRADE_SS)
                continue;
        }

        if($fitfastTarget->fitfast->type == Fitfast::FITFAST_TYPE_IMPLEMENT)
        {
            if($k == $fitfastTarget::GRADE_s)
                continue;
        }

        if($fitfastTarget->grade == $k){
            switch($k){
                case $fitfastTarget::GRADE_s:
                    $btnClass = 'btn-success';
                    break;
                case $fitfastTarget::GRADE_S:
                    $btnClass = 'btn-success';
                    break;
                case $fitfastTarget::GRADE_SS:
                    $btnClass = 'btn-success';
                    break;
                default:
                    $btnClass = 'btn-danger';
            }
        }

        echo CHtml::ajaxLink($v, $this->createUrl('default/updateGrade'), array(
            'type' => 'post',
            'data' => 'js:{grade:"'.$k.'", fitfastTargetId:' . $fitfastTarget->fitfastTargetId . '}',
            'dataType' => 'json',
            'success'=>'js:function(data){
                clearBtnClass('.$fitfastTarget->fitfastTargetId.');
                addBtnClass('.$fitfastTarget->fitfastTargetId.', data.grade);
                updateSummary(data.grades, data.percent);
            }',
        ), array(
            'class' => 'btn btn-mini ' . $btnClass,
            'id' => 'btn'.$fitfastTarget->gradeText($k).$fitfastTarget->fitfastTargetId,
            'confirm' => 'confirm!!',
        ));
    }
    ?>
</div>
<?php
Yii::app()->clientScript->registerScript('btnClass', "
    function clearBtnClass(id) {
        $('#btns'+id).removeClass('btn-success');
        $('#btnS'+id).removeClass('btn-success');
        $('#btnSS'+id).removeClass('btn-success');
        $('#btnF'+id).removeClass('btn-danger');
    }

    function addBtnClass(id, grade){
        var btnClass = '';
        switch(grade){
            case 'F':
                btnClass = 'btn-danger';
                break;
            default:
                btnClass = 'btn-success';
        }

        $('#btn'+grade+id).addClass(btnClass);
    }

    function updateSummary(grades, percent){
        $('.chart').data('easyPieChart').update(percent);
        $('p.percent').html(percent);
        $('span#s').html(grades.s+'s');
        $('span#S').html(grades.S+'S');
        $('span#SS').html(grades.SS+'SS');
        $('span#F').html(grades.F+'F');
    }
");
?>