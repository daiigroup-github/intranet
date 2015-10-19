<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_media".
 *
 * @property integer $mediaId
 * @property integer $status
 * @property string $name
 * @property integer $requireOther
 */
class QsafMediaMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'requireOther'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mediaId' => 'Media ID',
            'status' => 'Status',
            'name' => 'Name',
            'requireOther' => 'Require Other',
        ];
    }
}
