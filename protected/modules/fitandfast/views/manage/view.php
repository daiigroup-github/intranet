<?php
/* @var $this ManageController */
/* @var $model Fitfast */

$this->breadcrumbs = array(
    'Fitfasts' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Fitfast', 'url' => array('index')),
    array('label' => 'Create Fitfast', 'url' => array('create')),
    array('label' => 'Update Fitfast', 'url' => array('update', 'id' => $model->fitfastId)),
    array('label' => 'Delete Fitfast', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->fitfastId), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Fitfast', 'url' => array('admin')),
);

$this->breadcrumb = '<li>' . CHtml::link('Manage Fit And Fast', $this->createUrl('index')) . '<span class="divider">/</span> View</li>';

$this->pageHeader = $model->title;
?>

<div class="pull-right">
    <?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class' => 'btn btn-xs btn-primary')); ?>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'htmlOptions' => array('class' => 'table table-bordered table-striped table-hover'),
    'attributes' => array(
//            'fitfastId',
//            'status',
//            'createDateTime',
//            'updateDateTime',
//            'fitfastEmployeeId',
//        'employeeId',
        array(
            'name' => 'employeeId',
            'value' => $model->employee->fnTh . ' ' . $model->employee->lnTh,
        ),
//        'title',
        'description',
//        'type',
        array(
            'name' => 'type',
            'value' => substr(ucfirst($model->fitfastTypeText), 0, 1)
        ),
        array(
            'name' => 'halfS',
            'type' => 'raw',
            'value' => '<span id="fitfast-s">' . $model->halfS . '</span>',
        ),
        array(
            'name' => 'S',
            'type' => 'raw',
            'value' => '<span id="fitfast-S">' . $model->S . '</span>',
        ),
        array(
            'name' => 'SS',
            'type' => 'raw',
            'value' => '<span id="fitfast-SS">' . $model->SS . '</span>',
        ),
        array(
            'name' => 'F',
            'type' => 'raw',
            'value' => '<span id="fitfast-F">' . $model->F . '</span>',
        ),
    ),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fitfast-employee-grid',
    'dataProvider' => new CArrayDataProvider($model->fitfastTargets, array(
        'keyField' => 'fitfastTargetId',
        'pagination' => array(
            'pageSize' => 12,
        ),
    )),
    //'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'columns' => array(
//                array('class' => 'IndexColumn'),
        array(
            'name' => 'moth',
            'value' => '$data->getMonthThaiText($data->month)'
        ),
        'target',
        'file',
        array(
            'name' => 'grade',
            'type' => 'raw',
            'value' => '($data->grade) ? "<span id=grade{$data->fitfastTargetId}>".$data->gradeText($data->grade)."</span>" : "<span id=grade{$data->fitfastTargetId}>0</span>"',
        ),
        array(
            'class' => 'CButtonColumn',
            'htmlOptions' => array(
                'style' => 'width:150px;'
            ),
            'template' => '{s} {S} {SS} {F} {cancel} {update}',
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
                'cancel' => array(
                    'label' => 'X',
                    'options' => array(
                        'class' => 'btn btn-mini changeGrade'
                    ),
                    'visible'=>'$data->file ? 1 : 0',
                    'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/changeGrade/id/".$data->fitfastTargetId)',
                ),
                'update' => array(
                    'visible'=>'$data->file ? 0 : 1',
                    'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/update/id/".$data->fitfastTargetId)'
                ),
            ),
        ),
    ),
)); ?>

<?php
Yii::app()->clientScript->registerScript('changeGrade', "
    $(document).on('click', 'a.changeGrade', function(){
        if(!confirm('Are you sure you want to change grade?')) return false;

        $.ajax({
            url : $(this).attr('href'),
            type : 'POST',
            dataType : 'json',
            success : function(data) {
                if(data.error) {
                    alert(data.error);
                } else {
                    $('#grade'+data.fitfastTarget['fitfastTargetId']).html(data.fitfastTarget['grade']);
                    $('#fitfast-s').html(data.fitfast['s']);
                    $('#fitfast-S').html(data.fitfast['S']);
                    $('#fitfast-SS').html(data.fitfast['SS']);
                    $('#fitfast-F').html(data.fitfast['F']);
                }
            }
        });
        return false;
    });
");
?>