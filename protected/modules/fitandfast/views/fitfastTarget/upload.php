<?php
/* @var $this FitfastTargetController */
/* @var $model FitfastTarget */

$this->pageHeader = 'Upload File';
?>

    <h3>หัวข้อ : <?php echo $model->fitfast->title; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'htmlOptions' => array('class' => 'table table-bordered table-striped table-hover'),
    'attributes' => array(
        'employeeId',
        'month',
        'target',
        array(
            'type' => 'raw',
            'name' => 'file',
            'value' => $model->file
        ),
        'grade',
    ),
)); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'fitfast-target-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
    ),
)); ?>

    <p class="alert">
        *** สามารถ upload ไฟล์ใหม่ได้จนกว่าจะมีการให้เกรด
    </p>

    <div class="control-group">
        <?php echo $form->labelEx($model,'file', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo $form->fileField($model,'file'); ?>
            <?php echo $form->error($model,'file'); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Upload'); ?>
    </div>

<?php $this->endWidget(); ?>