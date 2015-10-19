<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Employee all divisoins';
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<?php foreach ($res as $company): ?>
    <div class="panel">
        <div class="panel-heading"><?= $company['name']; ?></div>
        <div class="panel-body">
            <div class="row">​​​
                <?php foreach ($company['divisions'] as $division): ?>
                    <div class="col-md-4 col-sm-6">
                        <?php
                        $division['title'] = $division['name'];
                        $division['url'] = \yii\helpers\Url::to(['/fitandfast/report/employee-in-division', 'companyId' => $company['companyId'], 'divisionId' => $division['divisionId']]);
                        ?>
                        <?= $this->renderFile('@app/themes/pixel-admin/layouts/_fitandfast_panel.php', ['fitandfast' => $division]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
