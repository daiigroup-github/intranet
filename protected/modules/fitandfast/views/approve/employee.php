<?php
/* @var $this ApproveController */

$this->breadcrumbs=array(
	'Approve',
);

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fitfast-employee-grid',
    'dataProvider' => new CArrayDataProvider($fitfastTargetModels, array(
        'keyField' => 'fitfastTargetId',
    )),
    //'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'columns' => array(
//                array('class' => 'IndexColumn'),
        array(
            'name'=>'Employee',
            'value'=>'$data->employee->fnTh. " ".$data->employee->lnTh'
        ),
        array(
            'name' => 'month',
            'value' => '$data->getMonthThaiText($data->month)'
        ),
        'target',
        array(
            'type'=>'raw',
            'name'=>'file',
            'value'=>'CHtml::link("view file", Yii::app()->createUrl("/..".$data->file), array("class"=>"pdf"))'
        ),
        array(
            'class' => 'CButtonColumn',
            'htmlOptions' => array(
                'style' => 'width:110px;'
            ),
            'template' => '{s} {S} {SS} {F}',
//            'template' => '{s} {S} {SS} {F} {cancel} {update} {delete}',
            'buttons' => array(
                's' => array(
                    'options' => array(
                        'class' => 'btn btn-mini btn-success changeGrade',
                    ),
                    'visible'=>'$data->file ? 1 : 0',
                    'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/changeGrade/id/".$data->fitfastTargetId."/g/s")',
                ),
                'S' => array(
                    'options' => array(
                        'class' => 'btn btn-mini btn-success changeGrade'
                    ),
                    'visible'=>'$data->file ? 1 : 0',
                    'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/changeGrade/id/".$data->fitfastTargetId."/g/S")',
                ),
                'SS' => array(
                    'options' => array(
                        'class' => 'btn btn-mini btn-success changeGrade'
                    ),
                    'visible'=>'$data->file ? 1 : 0',
                    'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/changeGrade/id/".$data->fitfastTargetId."/g/SS")',
                ),
                'F' => array(
                    'options' => array(
                        'class' => 'btn btn-mini btn-danger changeGrade'
                    ),
                    'visible'=>'$data->file ? 1 : 0',
                    'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/changeGrade/id/".$data->fitfastTargetId."/g/F")',
                ),
            ),
        ),
    ),
)); ?>

<?php
Yii::app()->clientScript->registerScript('changeGrade', "
    $(document).on('click', 'a.changeGrade', function(){
        if(!confirm('Are you sure you want to change grade?')) return false;

        var btn = $(this);

        $.ajax({
            url : btn.attr('href'),
            type : 'POST',
            dataType : 'json',
            success : function(data) {
                if(data.error) {
                    alert(data.error);
                } else {
                    alert('Complete');
                    btn.parent().parent().remove();
                }
            }
        });
        return false;
    });
");
?>
