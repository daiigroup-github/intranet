<?php

namespace frontend\models;

use Yii;
use \common\models\master\MemoLogMaster;

/**
 * This is the model class for table "memo_log".
 *
 * @property integer $memoLogId
 * @property integer $memoId
 * @property integer $employeeId
 * @property string $remark
 * @property integer $status
 * @property string $createDateTime
class MemoLog extends \common\models\master\MemoLogMaster
*/
class MemoLog extends MemoLogMaster
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
