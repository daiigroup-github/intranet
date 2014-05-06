<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />

		<!--javascript-->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.tools.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/js/bootstrap.js"></script>

		<!-- Bootstrap-->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css" />
		<style>
			body
			{
				padding-top:50px;
			}

			span.required, .errorMessage
			{
				color:red;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap-responsive.css" />

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontawesome/css/font-awesome.css" />

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="../assets/ico/favicon.ico">
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/ico/apple-touch-icon-114-precomposed.png">
				<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/ico/apple-touch-icon-72-precomposed.png">
					<link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/ico/apple-touch-icon-57-precomposed.png">

						<title><?php echo CHtml::encode($this->pageTitle); ?></title>
						</head>

						<body>

							<?php if(!isset($_GET['device'])): ?>
								<div class="navbar navbar-fixed-top navbar-inverse">
									<div class="navbar-inner">
										<div class="container">
											<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</a>
											<a class="brand" href="<?php
											if(Yii::app()->user->name != "Guest")
											{
												echo Yii::app()->createUrl('/home');
											}
											else
											{
												echo "#";
											}
											?>">Daiichi Intranet</a>
											<div class="nav-collapse">

												<?php
												//if(!Yii::app()->user->isGuest):
												if(1 == 2):
													?>
													<ul class="nav">
														<!--  <li><a href="<?php echo Yii::app()->createUrl('/employee'); ?>">Employee</a></li>
														<li><a href="<?php echo Yii::app()->createUrl('/qtechProject'); ?>">Qtech Projects</a></li>
														<li><a href="<?php echo Yii::app()->createUrl('/customer'); ?>">Customer</a></li>-->
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">สมัครงาน<b class="caret"></b></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo Yii::app()->createUrl("application") ?>">สมัครงาน</a></li>
																<li><a href="<?php echo Yii::app()->createUrl("application/jobInterview") ?>">นัดสัมภาษณ์</a></li>
																<li><a href="<?php echo Yii::app()->createUrl("application/interview") ?>">ประเมิณ</a></li>
																<li><a href="<?php echo Yii::app()->createUrl("application/InterviewToCeo") ?>">นัดให้นายสัมภาษณ์</a></li>
																<li><a href="<?php echo Yii::app()->createUrl("application/ceo") ?>">นายสัมภาษณ์</a></li>
																<li><a href="<?php echo Yii::app()->createUrl("application/accept") ?>">รับพนักงาน</a></li>
															</ul>
														</li>
													</ul>
													<?php
												endif;
												if(Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu")
												{
													?>
													<ul class="nav">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">ลูกค้า<b class="caret"></b></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo Yii::app()->createUrl('/customer'); ?>">ทั้งหมด</a></li>
															</ul>
														</li>
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">ระยะทาง<b class="caret"></b></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo Yii::app()->createUrl('/mileage'); ?>">ระยะทาง</a></li>
															</ul>
														</li>
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">Construction<b class="caret"></b></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo Yii::app()->createUrl('/qtechProject'); ?>">Qtech Projects</a></li>
															</ul>
														</li>

														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">ข้อมูลหลัก<b class="caret"></b></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo Yii::app()->createUrl('/group'); ?>">กลุ่มพนักงาน</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/documentType/'); ?>">ประเภทเอกสาร</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/documentTemplateField/'); ?>">ฟิลด์ของเอกสาร</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/documentControlType/'); ?>">document Control Type</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/documentControlData/'); ?>">document Control Data</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/workflowGroup/'); ?>">กลุ่มของ Workflow</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/workflow/'); ?>">Workflow</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/workflowStatus/'); ?>">สถานะ Workflow</a></li>
															</ul>
														</li>

														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">ผู้ดูแลระบบ<b class="caret"></b></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo Yii::app()->createUrl('/document/admin'); ?>">การจัดการ เอกสาร</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/noticeType/admin'); ?>">การจัดการ ประเภท ประกาศ</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('rights'); ?>">Rights</a></li>
															</ul>
														</li>

													</ul>

													<?php
												}
												?>
												<ul class="nav">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">โรงหนัง<b class="caret"></b></a>
														<ul class="dropdown-menu">
															<li><a href="<?php echo Yii::app()->createUrl('theater/reserve/myReservedList'); ?>">รายการจองดูหนังของฉัน</a></li>
															<li><a href="<?php echo Yii::app()->createUrl('theater'); ?>">จองดูหนัง</a></li>
															<?php
															if(Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu" || Yii::app()->user->name == "kbw" || Yii::app()->user->name == "ssd")
															{
																?>
																<li><a href="<?php echo Yii::app()->createUrl('theater/theater'); ?>">การจัดการ โรงหนัง</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/theater/theaterCategory'); ?>">การจัดการหมวดหมู่หนัง</a></li>
																<li><a href="<?php echo Yii::app()->createUrl('/theater/theaterMovie'); ?>">การจัดการหนัง และรอบฉาย</a></li>
															<?php } ?>
														</ul>
													</li>
												</ul>

												<ul class="nav pull-right">
													<li class="dropdown" >
														<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i><?php echo (!Yii::app()->user->isGuest) ? strtoupper(Yii::app()->user->name) : ''; //CHtml::link('เข้าสู่ระบบ', Yii::app()->createUrl('/site/login'));                                                                   ?><b class="caret"></b></a>
														<ul class="dropdown-menu">
															<li><a href="<?php echo Yii::app()->createUrl('/employee/' . Yii::app()->user->id); ?>"><i class="icon-user"></i>ข้อมูลส่วนตัว</a></li>
															<li><a href="<?php echo Yii::app()->createUrl('/employee/changePassword/' . Yii::app()->user->id); ?>"><i class="icon-key"></i>เปลี่ยนรหัสผ่าน</a></li>
															<li><a href="<?php echo Yii::app()->createUrl('/leaveReport/leaveReport'); ?>"><i class="icon-list"></i>รายการใบลา</a></li>
															<li><a href="<?php echo Yii::app()->createUrl('/document/viewFixtime/' . Yii::app()->user->id); ?>"><i class="icon-list"></i>รายการใบแก้ไขเวลา</a></li>
															<li class="divider"></li>
															<li><a href="<?php echo Yii::app()->createUrl('/site/logout/'); ?>"><i class="icon-signout"></i>ออกจากระบบ</a></li>
														</ul>
													</li>
												</ul>
											</div><!--/.nav-collapse -->
										</div>
									</div>
								</div>
							<?php endif; ?>

							<div class="container">

								<?php echo $content; ?>
							</div>
							<?php /* if(isset($this->breadcrumb)):?>
							  <div class="row">
							  <div class="span12">
							  <ul class="breadcrumb">
							  <li><i class="icon-home"></i><span class="divider">/</span></li>
							  <?php if(isset($this->breadcrumb)) echo $this->breadcrumb;?>
							  </ul>
							  </div>
							  </div>
							  <?php endif;?>

							  <div class="clear"></div>
							  <!--
							  <div id="footer">
							  Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
							  All Rights Reserved.<br/>
							  <?php echo Yii::powered(); ?>
							  </div> footer -->

							  </div><!-- page -->
							 */ ?>

						</body>
						</html>
