<?php

namespace frontend\models;

use Yii;
use \common\models\master\LeaveItemMaster;

/**
 * This is the model class for table "leave_item".
 *
 * @property integer $leaveItemId
 * @property string $leaveId
 * @property integer $status
 * @property string $leaveDate
 * @property double $leaveTime
 * @property integer $leaveTimeType
class LeaveItem extends \common\models\master\LeaveItemMaster
*/
class LeaveItem extends LeaveItemMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
