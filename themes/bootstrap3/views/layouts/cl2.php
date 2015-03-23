<style>
    body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
    }
</style>
<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php require_once 'tpl_header.php'; ?>
<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<?php if(isset($this->pageTitle)) echo '<div class="page-header text-center"><h1>' . $this->pageTitle . '</h1></div>'; ?>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2">
		<div class="panel panel-default ">
			<!-- Default panel contents -->
			<div class="panel-heading"><?php echo $this->sideMenu["contact"][0]["label"]; ?></div>
			<!-- List group -->
			<?php
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->sideMenu['contact'],
				'htmlOptions'=>array(
					'class'=>'list-group'),
	'itemCssClass'=>'list-group-item',
			));
			?>

			<div class="panel-heading"><?php echo $this->sideMenu["masterData"][0]["label"]; ?></div>
			<!-- List group -->
			<?php
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->sideMenu['masterData'],
				'htmlOptions'=>array(
					'class'=>'list-group'),
				'itemCssClass'=>'list-group-item',
			));
			?>
                        
                        <div class="panel-heading"><?php echo $this->sideMenu["manageZone"][0]["label"]; ?></div>
			<!-- List group -->
			<?php
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->sideMenu['manageZone'],
				'htmlOptions'=>array(
					'class'=>'list-group'),
				'itemCssClass'=>'list-group-item',
			));
			?>



            <div class="panel-heading"><?php echo $this->sideMenu['rawMaterial'][0]["label"]; ?></div>
            <!-- List group -->
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items'=>$this->sideMenu['rawMaterial'],
                'htmlOptions'=>array(
                    'class'=>'list-group'),
                'itemCssClass'=>'list-group-item',
            ));
            ?>
		</div>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-10">
		<?php
		if(isset($this->breadcrumbs))
		{
			$this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'separator'=>' ',
				'tagName'=>'ol',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array(
					'class'=>'breadcrumb'
				),
			));
		}
		?>

		<?php echo $content; ?>
	</div>
</div>
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/navbar-fixed-top.css'); ?>
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/style.css'); ?>
<?php $this->endContent(); ?>