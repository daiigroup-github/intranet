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

$this->pageHeader = $data['company'];
?>

<div class="row">
	<!-- block -->
	<div class="span9">
		<h3>ฝ่าย :: <?php echo $data['division']; ?></h3>

		<ul class="thumbnails">

			<?php foreach($data['employee'] as $employee): ?>
				<?php if($employee['employeeId'] == 1) continue; ?>
				<li class="span3">
					<div class="thumbnail">
						<a href="<?php echo $this->createUrl('default/index/' . $employee['employeeId']); ?>"><i class="icon-search"></i></a>
							<?php echo $employee['name']; ?>
							<?php
							$this->renderPartial('fitfast.views.default._chart', array(
								'percent'=>$employee['percent'], 'id'=>$employee['employeeId']));
							?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php
		/*
		  <table class="table table-striped table-hover">
		  <?php foreach($data['employee'] as $employee): ?>
		  <?php if($employee['employeeId'] == 1) continue; ?>
		  <tr>
		  <td>
		  <a href="<?php echo $this->createUrl('default/employee/' . $employee['employeeId']); ?>"><i class="icon-search"></i></a>
		  <?php echo $employee['name']; ?>
		  </td>
		  </tr>
		  <?php endforeach; ?>
		  </table>
		 *
		 */
		?>
	</div>
	<!-- /block -->
</div>
