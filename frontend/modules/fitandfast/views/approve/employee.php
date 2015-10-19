<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use frontend\assets\FancyBoxAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$title = 'Fit and Fast Approve Employees';
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['pageHeader'] = Html::encode($title);
FancyBoxAsset::register($this);
?>
    <div class="fitfast-approve-employee">
        <div class="panel">
            <div class="panel-heading">
                All waiting for your approve.
            </div>
            <div class="panel-body">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'layout' => "{summary}\n{items}\n{pager}\n",
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'options' => ['class' => 'pagination pagination-xs']
                    ],
                    'options' => [
                        'class' => 'table-light'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'employeeId',
                            'label' => 'Employee',
                            'value' => function ($model) {
                                return $model->fitfast->fitfastEmployee->employee->fullThName;
                            }
                        ],
                        'target',
                        [
                            'attribute' => 'month',
                            'value' => function ($model) {
                                return $model->getMonthText($model->month);
                            }
                        ],
                        [
                            'attribute'=>'file',
                            'format'=>'raw',
                            'value'=>function($model){
                                return Html::a('View File', [$model->file], ['rel' => 'fancyboxPDF', 'class'=>'fancyBoxPDF']);
                            }
                        ],
                        [
                            'attribute' => 'grade',
                            'value' => function ($model) {
                                return $model->gradeText;
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'template' => '{S} {F}',
                            'buttons' => [
                                'S' => function ($url, $model) {
                                    return Html::a('S', $url, [
                                        'title' => $model->fitfastTargetId,
                                        'class' => 'btn btn-primary btn-xs grade',
                                    ]);
                                },
                                'F' => function ($url, $model) {
                                    return Html::a('F', $url, [
                                        'title' => $model->fitfastTargetId,
                                        'class' => 'btn btn-danger btn-xs grade',
                                    ]);
                                },
                            ]
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
<?php
$this->registerJs("
    $('.grade').click(function(){
        var fitfastTargetId = $(this).attr('title');
        var grade = $(this).html();
        var btn = $(this);

        if(confirm('Grade : '+grade)){
            //ajax
            $.ajax({
                type : 'POST',
                url:'" . Yii::$app->request->baseUrl . "/fitandfast/approve/grade',
                data:{grade:grade, fitfastTargetId:fitfastTargetId},
                dataType : 'json',
                success:function(data){
//                  console.log(data.res);
                    if(data.result == true) {
                        alert('Save Complete.');
                        btn.parent().parent().remove();
                    } else {
                        alert('Error!! Please try again.');
                    }
                }
            });
        }

        return false;
    });
", \yii\web\View::POS_END);
?>