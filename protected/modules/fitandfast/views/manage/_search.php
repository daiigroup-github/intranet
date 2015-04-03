<?php
/* @var $this ManageController */
/* @var $model Fitfast */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id' => 'search-form',
)); ?>
<div class="input-prepend">
    <button class="btn btn-default" type="submit">Search</button>
    <?php echo $form->textField($model, 'searchText', array('class' => '')); ?>
</div>
<?php echo $form->dropDownList($model, 'employeeId', CHtml::listData(Employee::model()->findAll(array('condition'=>'status=1 and employeeId!=1', 'order'=>'fnTh')), 'employeeId', 'fullName'), array('prompt'=>'พนักงานทั้งหมด'));?>
<?php $this->endWidget(); ?>
