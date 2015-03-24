<?php
$this->pageHeader = 'Monthly Report';
?>

<?php foreach ($data as $k => $v): ?>
    <div class="row">
        <!-- block -->
        <div class="span9">
            <h3><?php echo $k;?></h3>
            <ul class="thumbnails">

                <li class="span3">
                    <h4><?php echo 'พนักงาน';?></h4>
                    <div class="thumbnail">
                        <?php
                        $this->renderPartial('_chart', array(
                            'percent' => $v['employeePercent'],
                            'id' => uniqid(),
                            'span' => 3
                        ));
                        ?>
                    </div>
                </li>
                <li class="span3">
                    <h4><?php echo 'ผู้บริหาร';?></h4>
                    <div class="thumbnail">
                        <?php
                        $this->renderPartial('_chart', array(
                            'percent' => $v['managerPercent'],
                            'id' => uniqid(),
                            'span' => 3
                        ));
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>
