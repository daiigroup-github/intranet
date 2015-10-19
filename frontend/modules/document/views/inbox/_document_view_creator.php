<div class="panel panel-info panel-body-colorful">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <p>
                    สร้างโดย : <?= $model->employee->fullThName ?> (<?= strtoupper($model->employee->username) ?>)
                </p>
                <p>
                    บริษัท : <?=$model->employee->company->companyNameTh?> | สาขา : <?=$model->employee->branch->branchName?> | ฝ่าย : <?=$model->employee->companyDivision->description?>
                </p>

            </div>
            <div class="col-md-6 text-right">
                สร้างเมื่อ : <?= $model->createDateTime ?>
            </div>
        </div>
    </div>
</div>