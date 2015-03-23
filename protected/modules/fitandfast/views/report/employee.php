<?php
/* @var $this FitAndFastController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Fit And Fasts' => Yii::app()->createUrl('/fitAndFast'),
    'Division',
);

$this->menu = array(
    array(
        'label' => 'Create FitAndFast',
        'url' => array(
            'create'
        )
    ),
    array(
        'label' => 'Manage FitAndFast',
        'url' => array(
            'admin'
        )
    ),
);
?>

<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

$this->pageHeader = 'สรุป Fit And Fast พนักงาน (' . $sumPercent . '%)';
?>

<?php foreach ($data as $company): ?>

    <div class="row">
        <!-- block -->
        <div class="span9">

            <?php if (empty($company['division'])) continue; ?>
            <h3>บริษัท :: <?php echo $company['companyName']; ?></h3>

            <ul class="thumbnails">
                <?php foreach ($company['division'] as $division): ?>
                    <?php //if($employee['employeeId'] == 1) continue; ?>
                    <li class="span3">
                        <div class="thumbnail">
                            <p>
                                <a href="<?php echo $this->createUrl('report/division/' . $company['companyId'] . '/' . $division['companyDivisionId']); ?>"><i
                                        class="icon-search"></i></a>
                                <?php echo $division['description']; ?>
                            </p>
                            <?php
                            $this->renderPartial('_chart', array(
                                'percent' => $division['percent'],
                                'id' => uniqid(),
                                'span' => 3
                            ));
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /block -->
    </div>
<?php endforeach; ?>
