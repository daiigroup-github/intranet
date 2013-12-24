<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />

		<!--javascript-->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.tools.min.js"></script>

		<!-- blueprint CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->

	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /-->

		<!-- Bootstrap-->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap-responsive.css" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body>

		<div class="container" id="page">

			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="#">Project name</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="active"><a href="#">Home</a></li>
								<li><a href="#about">About</a></li>
								<li><a href="#contact">Contact</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div>

			<div id="header">
				<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
			</div><!-- header -->

			<div id="mainmenu">
				<?php
				$this->widget('zii.widgets.CMenu', array(
					'items' => array(
						//array('label'=>'Home', 'url'=>array('/site/index')),
						//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						//array('label'=>'Contact', 'url'=>array('/site/contact')),
						array(
							'label' => 'Employee',
							'url' => array(
								'/employee')),
						array(
							'label' => 'Qtech Project',
							'url' => array(
								'/qtechProject')),
						array(
							'label' => 'Customer',
							'url' => array(
								'/customer')),
						array(
							'label' => 'Login',
							'url' => array(
								'/site/login'),
							'visible' => Yii::app()->user->isGuest),
						array(
							'label' => 'Logout (' . Yii::app()->user->name . ')',
							'url' => array(
								'/site/logout'),
							'visible' => !Yii::app()->user->isGuest)
					),
				));
				?>
			</div><!-- mainmenu -->

			<div class="row">
				<div class="span12">
					<?php if (isset($this->breadcrumbs)): ?>
						<?php
						$this->widget('zii.widgets.CBreadcrumbs', array(
							'links' => $this->breadcrumbs,
						));
						?><!-- breadcrumbs -->
					<?php endif ?>
				</div>
			</div>

			<ul class="breadcrumb">
				<li><a href="<?php Yii::app()->createUrl('/employee'); ?>"><i class="icon-home"></i></a><span class="divider">/</span></li>
				<?php if (isset($this->breadcrumb)) echo $this->breadcrumb; ?>
			</ul>

			<?php echo $content; ?>

			<div class="clear"></div>

			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
			</div><!-- footer -->

		</div><!-- page -->

	</body>
</html>
