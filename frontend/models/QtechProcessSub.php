<?php

namespace frontend\models;

use Yii;
use \common\models\master\QtechProcessSubMaster;

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
class QtechProcessSub extends \common\models\master\QtechProcessSubMaster
*/
class QtechProcessSub extends QtechProcessSubMaster
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
