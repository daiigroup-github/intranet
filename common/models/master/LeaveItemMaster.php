<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "leave_item".
 *
 * @property integer $leaveItemId
 * @property string $leaveId
 * @property integer $status
 * @property string $leaveDate
 * @property double $leaveTime
 * @property integer $leaveTimeType
 */
class LeaveItemMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'leaveTimeType'], 'integer'],
            [['leaveDate'], 'safe'],
            [['leaveTime', 'leaveTimeType'], 'required'],
            [['leaveTime'], 'number'],
            [['leaveId'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'leaveItemId' => 'Leave Item ID',
            'leaveId' => 'Leave ID',
            'status' => 'Status',
            'leaveDate' => 'Leave Date',
            'leaveTime' => 'Leave Time',
            'leaveTimeType' => 'Leave Time Type',
        ];
    }
}
