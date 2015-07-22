<?php

namespace frontend\models;

use Yii;
use \common\models\master\MemoMaster;

/**
 * This is the model class for table "memo".
 *
 * @property integer $memoId
 * @property string $subject
 * @property string $detail
 * @property string $image
 * @property integer $createBy
 * @property string $createDateTime
class Memo extends \common\models\master\MemoMaster
*/
class Memo extends MemoMaster
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
