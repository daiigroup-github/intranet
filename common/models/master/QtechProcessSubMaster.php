<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qtech_process_sub".
 *
 * @property integer $qtechProcessSubId
 * @property integer $status
 * @property integer $qtechProjectId
 * @property integer $qtechProcessId
 * @property integer $engineerId
 * @property integer $employeeId
 * @property string $processSubName
 * @property string $processSubDetail
 * @property integer $earningPrecent
 * @property double $contractorCost
 * @property integer $duration
 * @property integer $paymentNo
 */
class QtechProcessSubMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtech_process_sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'qtechProjectId', 'qtechProcessId', 'engineerId', 'employeeId', 'earningPrecent', 'duration', 'paymentNo'], 'integer'],
            [['qtechProjectId', 'qtechProcessId', 'engineerId', 'employeeId', 'processSubName', 'processSubDetail', 'earningPrecent'], 'required'],
            [['contractorCost'], 'number'],
            [['processSubName', 'processSubDetail'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qtechProcessSubId' => 'Qtech Process Sub ID',
            'status' => 'Status',
            'qtechProjectId' => 'Qtech Project ID',
            'qtechProcessId' => 'Qtech Process ID',
            'engineerId' => 'Engineer ID',
            'employeeId' => 'Employee ID',
            'processSubName' => 'Process Sub Name',
            'processSubDetail' => 'Process Sub Detail',
            'earningPrecent' => 'Earning Precent',
            'contractorCost' => 'Contractor Cost',
            'duration' => 'Duration',
            'paymentNo' => 'Payment No',
        ];
    }
}
