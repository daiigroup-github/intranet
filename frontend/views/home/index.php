<?php
/* @var $this yii\web\View */
$this->title = 'Home';
$this->params['pageHeader'] = '<i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;' . $this->title;
$this->params['breadcrumbs'] = ['Dashboard'];
?>

<div class="row">
    <div class="col-md-12">

        <?php echo $this->render('_fit_and_fast', compact('fitandfastEmployee', 'cummulateGrade', 'fitfastStat'));?>

    </div>
    <?php
    /*
    <div class="col-md-4">

        <!-- 10. $SUPPORT_TICKETS ==========================================================================

    Support tickets
-->
        <!-- Javascript -->
        <script>
            init.push(function () {
                $('#dashboard-support-tickets .panel-body > div').slimScroll({
                    height: 300,
                    alwaysVisible: true,
                    color: '#888',
                    allowPageScroll: true
                });
            })
        </script>
        <!-- / Javascript -->

        <div class="panel panel-success widget-support-tickets" id="dashboard-support-tickets">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-folder-o"></i>เอกสารรออนุมัติ</span>

                <div class="panel-heading-controls">
                    <div class="panel-heading-text"><a href="#">15 รายการ</a></div>
                </div>
            </div>
            <!-- / .panel-heading -->
            <div class="panel-body tab-content-padding">
                <!-- Panel padding, without vertical padding -->
                <div class="panel-padding no-padding-vr">

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบลา<span>[#RLE2015012986]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">ประเสริฐ ศาสตร์ภักดี</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบดำเนินการเกี่ยวกับ Website ของบริษัท<span>[#RFWE2014120053]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">วชิราภรณ์ สกุลจันทร์</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบขอให้ฝ่ายไอที บริการ<span>[#RIT2015010339]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">วณต บุญเรือน</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบขอซื้อเกี่ยวกับไอที<span>[#RIO2015010218]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">ปิยฉัตร สารพัฒน์</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบดำเนินการเกี่ยวกับ Website ของบริษัท<span>[#RFWE2014120053]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">วชิราภรณ์ สกุลจันทร์</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบลา<span>[#RLE2015012986]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">ประเสริฐ ศาสตร์ภักดี</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                </div>
            </div>
            <!-- / .panel-body -->
        </div>
        <!-- / .panel -->
        <!-- /10. $SUPPORT_TICKETS -->

    </div>
    */
?>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- 10. $SUPPORT_TICKETS ==========================================================================

   Support tickets
-->
        <!-- Javascript -->
        <script>
            init.push(function () {
                $('#dashboard-support-tickets .panel-body > div').slimScroll({
                    height: 300,
                    alwaysVisible: true,
                    color: '#888',
                    allowPageScroll: true
                });
            })
        </script>
        <!-- / Javascript -->

        <div class="panel panel-success widget-support-tickets" id="dashboard-support-tickets">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-folder-o"></i>เอกสารรออนุมัติ</span>

                <div class="panel-heading-controls">
                    <div class="panel-heading-text"><a href="#">15 รายการ</a></div>
                </div>
            </div>
            <!-- / .panel-heading -->
            <div class="panel-body tab-content-padding">
                <!-- Panel padding, without vertical padding -->
                <div class="panel-padding no-padding-vr">

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบลา<span>[#RLE2015012986]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">ประเสริฐ ศาสตร์ภักดี</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบดำเนินการเกี่ยวกับ Website ของบริษัท<span>[#RFWE2014120053]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">วชิราภรณ์ สกุลจันทร์</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบขอให้ฝ่ายไอที บริการ<span>[#RIT2015010339]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">วณต บุญเรือน</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบขอซื้อเกี่ยวกับไอที<span>[#RIO2015010218]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">ปิยฉัตร สารพัฒน์</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบดำเนินการเกี่ยวกับ Website ของบริษัท<span>[#RFWE2014120053]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">วชิราภรณ์ สกุลจันทร์</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                    <div class="ticket">
                        <a href="#" title="" class="ticket-title">ใบลา<span>[#RLE2015012986]</span></a>
								<span class="ticket-info">
									สร้างโดย <a href="#" title="">ประเสริฐ ศาสตร์ภักดี</a> <br />
                                    23/01/2558 15:37:08
								</span>
                    </div>
                    <!-- / .ticket -->

                </div>
            </div>
            <!-- / .panel-body -->
        </div>
        <!-- / .panel -->
        <!-- /10. $SUPPORT_TICKETS -->
    </div>
</div>