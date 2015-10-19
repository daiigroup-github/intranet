<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "notice_type".
 *
 * @property integer $noticeTypeId
 * @property string $noticeTypeCode
 * @property string $noticeTypeName
 * @property string $createDateTime
 */
class NoticeTypeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noticeTypeCode', 'noticeTypeName', 'createDateTime'], 'required'],
            [['createDateTime'], 'safe'],
            [['noticeTypeCode'], 'string', 'max' => 10],
            [['noticeTypeName'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'noticeTypeId' => 'Notice Type ID',
            'noticeTypeCode' => 'Notice Type Code',
            'noticeTypeName' => 'Notice Type Name',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
