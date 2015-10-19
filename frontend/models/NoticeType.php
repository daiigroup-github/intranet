<?php

namespace frontend\models;

use Yii;
use \common\models\master\NoticeTypeMaster;

/**
 * This is the model class for table "notice_type".
 *
 * @property integer $noticeTypeId
 * @property string $noticeTypeCode
 * @property string $noticeTypeName
 * @property string $createDateTime
class NoticeType extends \common\models\master\NoticeTypeMaster
*/
class NoticeType extends NoticeTypeMaster
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
