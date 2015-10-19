<?php

namespace frontend\models;

use Yii;
use \common\models\master\QtechProcessMaster;

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
class QtechProcess extends \common\models\master\QtechProcessMaster
*/
class QtechProcess extends QtechProcessMaster
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
