<?php
$this->title = 'Document';
$this->params['pageHeader'] = '<i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;' . $this->title;
$this->params['breadcrumbs'] = [$this->title];
?>

<?php foreach ($companyDivisionModels as $companyDivisionModel): ?>
    <?php if ($companyDivisionModel->documentTypes == []) continue; ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?= $companyDivisionModel->description ?></div>
        <div class="panel-body">
            <div class="row">
            <?php foreach ($companyDivisionModel->documentTypes as $documentType): ?>
                <div class="col-md-6 col-sm-12">
                    <?=\yii\helpers\Html::a($documentType->documentTypeName, ['/document/create/'.$documentType->documentTypeId], ['class'=>'btn btn-default btn-lg thumbnail'])?>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
