<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<div class="fitandfast-default-index">
    <div class="row">
        <div class="col-md-3">
            <?= $this->renderFile('@app/themes/pixel-admin/layouts/_fitandfast_panel.php', ['fitandfast' => $fitfastEmployee->summaryByEmployeeId($employeeModel->employeeId)]); ?>
        </div>
        <div class="col-md-9">
            <?php foreach ($fitfastEmployee->fitfasts as $fitfastModel): ?>
                <div class="panel colourable panel-info">
                    <div class="panel-heading"><?= $fitfastModel->title ?></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Summary</h4>
                                <table class="table table-striped table-bordered table-condensed">
                                    <tr>
                                        <th>s</th>
                                        <th>S</th>
                                        <th>SS</th>
                                        <th>F</th>
                                    </tr>
                                    <tr>
                                        <td><?= ($fitfastModel->halfS != 0) ? $fitfastModel->halfS : '-' ?></td>
                                        <td><?= ($fitfastModel->S != 0) ? $fitfastModel->S : '-' ?></td>
                                        <td><?= ($fitfastModel->SS != 0) ? $fitfastModel->SS : '-' ?></td>
                                        <td><?= ($fitfastModel->F != 0) ? $fitfastModel->F : '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-9">
                                <h4>Target</h4>

                                <?= GridView::widget([
//                                    'layout' => "{summary}\n{items}\n{pager}\n",
                                    'layout' => "{items}",
                                    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $fitfastModel->getFitfastTargets()]),
                                    'pager' => [
                                        'options' => ['class' => 'pagination pagination-xs']
                                    ],
                                    'options' => [
                                        'class' => 'table-light'
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        'target',
                                        [
                                            'attribute' => 'month',
                                            'value' => function ($model) {
                                                return $model->getMonthText($model->month);
                                            }
                                        ],
                                        [
                                            'attribute' => 'file',
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                if ($model->file) {
                                                    //file url
                                                    return Html::a('View File', [$model->file], ['rel' => 'fancyboxPDF', 'class'=>'fancyBoxPDF']);
//                                                    return $model->file;
                                                } else {
                                                    //upload file
                                                    return Html::fileInput('file[' . $model->fitfastTargetId . ']');
                                                }
                                            }
                                        ],
                                        [
                                            'attribute' => 'grade',
                                            'value' => function ($model) {
                                                return ($model->grade != 0) ? $model->gradeText : '-';
                                            }
                                        ],
//                                ['class' => 'yii\grid\ActionColumn'],
                                    ],
                                ]); ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
