<?php
/* @var $this FitAndFastController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Fit And Fasts'=>Yii::app()->createUrl('/fitAndFast'),
	'Division',
);

$this->menu = array(
	array(
		'label'=>'Create FitAndFast',
		'url'=>array(
			'create')
	),
	array(
		'label'=>'Manage FitAndFast',
		'url'=>array(
			'admin')),
);
?>

<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div class="page-header">
	<h3><?php echo $data['company']; ?></h3>
</div>

<?php
echo CHtml::link('<i class="icon-plus-sign"></i> เพิ่มข้อมูล', Yii::app()->createUrl('fitAndFast/create'), array(
	'class'=>'btn btn-success pull-right'));
?>

<div class="row-fluid">
	<h3><?php echo $data['division']; ?></h3>
	<table class="table table-striped table-hover">
		<?php foreach($data['employee'] as $employee): ?>
			<tr>
				<td>
					<a href="<?php echo Yii::app()->createUrl('/fitAndFast/employee/' . $employee['employeeId']); ?>"><i class="icon-search"></i></a>
						<?php echo $employee['name']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>