<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<div class="panel">
    <div class="panel-heading">Document History</div>
    <div class="panel-body">
        <?=GridView::widget([
            'layout'=>'{items}',
            'dataProvider'=>$model->documentHistory(),
            'options'=>[
                'class'=>'table-light'
            ],
            'rowOptions'=>function($model){
                return ['class'=>($model->isOverEstimate) ? 'text-danger' : 'text-success'];
            },
            'columns'=>[
                ['class' => 'yii\grid\SerialColumn'],
                [
//                    'attribute'=>'employeeId',
                    'label'=>'พนักงาน',
                    'value'=>function($model){
                        return $model->employee->fullThName;
                    }
                ],
                [
                    'label'=>'Workflow State',
                    'value'=>function($model){
                        $workflowName = isset($model->workflowState->workflowCurrent) ? $model->workflowState->workflowCurrent->workflowName : '';
                        $workflowStatusName = isset($model->workflowState->workflowStatus) ? ' ('.$model->workflowState->workflowStatus->workflowStatusName.')' : '';

                        return $workflowName.$workflowStatusName;
                    }
                ],
                [
                    'label'=>'Create Date',
                    'value'=>function($model){
                        return $model->thaiDate($model->createDateTime);
                    }
                ],
                [
                    'label' => 'ระยะเวลาดำเนินการ',
                    'format'=>'raw',
                    'value'=>function($model){
                        $time1 = $model->workflowState->getEstimateTime($model->workflowState->estimateHour);
                        $time2 = $model->workflowState->getEstimateTime($model->numHour);

                        return 'ระยะเวลาที่ต้องดำเนินการ '.$time1['day'].' วัน '.$time1['hour'].' ชั่วโมง<br />'.
                        'ดำเนินเสร็จภายใน '.$time2['day'].' วัน '.$time2['hour'].' ชั่วโมง';
                    }
                ],
            ],
        ])?>
    </div>
</div>