<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->title = 'เอกสารถาดเข้า';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="document-inbox">
    <div class="panel">
        <div class="panel-heading"><?= $this->title ?></div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'filterModel' => $modelSearch,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'documentCode',
                    [
                        'attribute'=>'documentTypeId',
                        'label'=>'Document Type',
                        'filter'=>ArrayHelper::map(\frontend\models\DocumentType::find()->where('status=1')->all(), 'documentTypeId', 'documentTypeName'),
                        'value'=>function($model){
                            return $model->documentType->documentTypeName;
                        }
                    ],
                    [
                        'attribute'=>'employeeId',
                        'label'=>'Creator',
                        'value'=>function($model){
                            return $model->employee->fullThName;
                        }
                    ],
                    [
                        'attribute'=>'createDateTime',
                        'label'=>'Create Date',
                        'value'=>function($model){
                            return $model->thaiDate($model->createDateTime);
                        }
                    ],
                    [
                        'label'=>'Status',
                        'value'=>function($model){
                            return $model->getCurrentStatusByDocumentId($model->documentId);
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}'
                    ],
                ]
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
