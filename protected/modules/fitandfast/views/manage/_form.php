<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */
/* @var $form CActiveForm */
?>

<div class="row-fluid">
    <div class="span12">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'fit-and-fast-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'well'),
        ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row-fluid">
            <div class="span8">
                <?php echo $form->labelEx($fitfastEmployeeModel, 'employeeId'); ?>
                <?php
                echo $form->dropDownList($fitfastEmployeeModel, 'employeeId', CHtml::listData(Employee::model()->findAll(array(
                    'condition' => 'status=1',
                    'select' => 'employeeId, concat(fnTh, " ", lnTh) as fnTh',
                    'order' => 'fnTh'
                )), 'employeeId', 'fnTh'), array(
                    'class' => 'input-block-level',
                    'prompt' => 'เลือกพนักงาน'
                ));
                ?>
                <?php echo $form->error($fitfastEmployeeModel, 'employeeId'); ?>
            </div>
            <div class="span2">
                <?php echo $form->labelEx($model, 'type'); ?>
                <?php
                echo $form->dropDownList($model, 'type', $model->fitfastTypeArray, array(
                    'class' => 'input-block-level',
                    'prompt' => 'Select Type'));
                ?>
            </div>
            <div class="span2">
                <?php echo $form->labelEx($fitfastEmployeeModel, 'forYear'); ?>
                <?php
                echo $form->dropDownList($fitfastEmployeeModel, 'forYear', array(
                    date('Y') => date('Y'),
                    date("Y") + 1 => date('Y') + 1), array(
                    'class' => 'input-block-level'));
                ?>
            </div>
        </div>

        <?php echo $form->labelEx($model, 'title'); ?>
        <?php
        echo $form->textField($model, 'title', array(
            'class' => 'input-block-level'));
        ?>
        <?php echo $form->error($model, 'title'); ?>

        <?php echo $form->labelEx($model, 'description'); ?>
        <?php
        echo $form->textArea($model, 'description', array(
            'class' => 'input-block-level'));
        ?>
        <?php echo $form->error($model, 'description'); ?>

        <?php
        for ($i = 1; $i <= 3; $i++):
            ?>
            <div class="row-fluid">
                <?php
                $k = 1 + (4 * ($i - 1));
                for ($j = $k; $j < $k + 4; $j++):
                    ?>
                    <div class="span3">
                        <label><?php echo date('M', mktime(0,0,0,$j,1,date('Y')));?></label>
                        <?php echo  $form->textField($fitfastTargetModel, "[{$j}]target", array('class'=>'input-block-level', 'value'=>isset($targets[$j]['target']) ? $targets[$j]['target'] : ''));?>
                    </div>
                <?php
                endfor;
                ?>
            </div>
        <?php
        endfor;
        ?>

        <div class="row-fluid">
            <div class="span12">
                <label class="checkbox">
                    <?php
                    echo $form->checkBox($model, 'status');
                    ?>
                    <?php echo $model->getAttributeLabel('status'); ?>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <?php
            echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
                'class' => 'btn btn-primary'));
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
</div>