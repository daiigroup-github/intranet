<?php

namespace frontend\models;

use Yii;
use \common\models\master\MemoToMaster;

/**
 * This is the model class for table "memo_to".
 *
 * @property integer $id
 * @property integer $memoId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class MemoTo extends \common\models\master\MemoToMaster
*/
class MemoTo extends MemoToMaster
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
