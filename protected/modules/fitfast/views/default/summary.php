<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);

$this->pageHeader = 'Fit And Fast';

$this->breadcrumb = '<li>Fit And Fast</li>';
?>

<div class="row-fluid">
	<?php foreach($data as $company): ?>
		<!-- block -->
		<div class="span3">
			<div class="thumbnail">
				<h4><?php echo $company['name']; ?></h4>

				<table class="table table-striped table-hover">
					<?php foreach($company['division'] as $division): ?>
						<tr>
							<td>
								<a href="<?php echo $this->createUrl('default/division/' . $company['companyId'] . '/' . $division['divisionId']); ?>">
									<i class="icon-search"></i> <?php echo $division['name']; ?>
								</a>
								<div class="progress">
									<div class="bar" style="width: <?php //echo $division['score'];      ?>%;"></div>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<!-- /block -->
	<?php endforeach; ?>
</div>