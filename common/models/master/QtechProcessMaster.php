<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qtech_process".
 *
 * @property integer $qtechProcessId
 * @property integer $status
 * @property integer $qtechProjectId
 * @property string $processName
 * @property string $processDetail
 * @property integer $duration
 * @property integer $engineerId
 * @property integer $earningPercent
 * @property string $contracttorCost
 * @property string $paymentNo
 * @property integer $parentId
 * @property integer $level
 */
class QtechProcessMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtech_process';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'qtechProjectId', 'duration', 'engineerId', 'earningPercent', 'parentId', 'level'], 'integer'],
            [['qtechProjectId', 'processName', 'processDetail', 'duration'], 'required'],
            [['contracttorCost'], 'number'],
            [['processName'], 'string', 'max' => 100],
            [['processDetail'], 'string', 'max' => 120],
            [['paymentNo'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qtechProcessId' => 'Qtech Process ID',
            'status' => 'Status',
            'qtechProjectId' => 'Qtech Project ID',
            'processName' => 'Process Name',
            'processDetail' => 'Process Detail',
            'duration' => 'Duration',
            'engineerId' => 'Engineer ID',
            'earningPercent' => 'Earning Percent',
            'contracttorCost' => 'Contracttor Cost',
            'paymentNo' => 'Payment No',
            'parentId' => 'Parent ID',
            'level' => 'Level',
        ];
    }
}
