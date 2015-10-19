<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "memo".
 *
 * @property integer $memoId
 * @property string $subject
 * @property string $detail
 * @property string $image
 * @property integer $createBy
 * @property string $createDateTime
 */
class MemoMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'memo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'detail', 'createBy', 'createDateTime'], 'required'],
            [['createBy'], 'integer'],
            [['createDateTime'], 'safe'],
            [['subject'], 'string', 'max' => 1000],
            [['detail'], 'string', 'max' => 3000],
            [['image'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'memoId' => 'Memo ID',
            'subject' => 'Subject',
            'detail' => 'Detail',
            'image' => 'Image',
            'createBy' => 'Create By',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
