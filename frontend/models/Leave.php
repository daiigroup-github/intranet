<?php

namespace frontend\models;

use Yii;
use \common\models\master\LeaveMaster;

/**
 * This is the model class for table "leave".
 *
 * @property integer $leaveId
 * @property integer $status
 * @property string $documentId
 * @property integer $leaveType
 * @property integer $isLate
 * @property string $filePath
class Leave extends \common\models\master\LeaveMaster
*/
class Leave extends LeaveMaster
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
