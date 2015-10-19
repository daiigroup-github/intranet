<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property integer $provinceId
 * @property string $provinceName
 * @property integer $geographyId
 * @property integer $status
 */
class ProvinceMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinceName', 'geographyId'], 'required'],
            [['geographyId', 'status'], 'integer'],
            [['provinceName'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provinceId' => 'Province ID',
            'provinceName' => 'Province Name',
            'geographyId' => 'Geography ID',
            'status' => 'Status',
        ];
    }
}
