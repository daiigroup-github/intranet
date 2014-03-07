<?php
/* @var $this FitAndFastController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Manage',);

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
echo CHtml::link('<i class="icon-plus-sign"></i> เพิ่มข้อมูล', Yii::app()->createUrl('fitAndFast/create'), array(
	'class'=>'btn btn-success pull-right'));
?>

<?php foreach($data as $company): ?>
	<div class="row-fluid">
		<h3><?php echo $company['name']; ?></h3>
		<table class="table table-striped table-hover">
			<?php foreach($company['division'] as $division): ?>
				<tr>
					<td>
						<a href="<?php echo Yii::app()->createUrl('/fitAndFast/division/' . $company['companyId'] . '/' . $division['divisionId']); ?>"><i class="icon-search"></i></a> <?php echo $division['name']; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
<?php endforeach; ?>
