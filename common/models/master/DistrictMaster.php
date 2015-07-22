<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $districtId
 * @property string $districtCode
 * @property string $districtName
 * @property integer $amphurId
 * @property integer $provinceId
 * @property integer $geographyId
 */
class DistrictMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['districtCode', 'districtName'], 'required'],
            [['amphurId', 'provinceId', 'geographyId'], 'integer'],
            [['districtCode'], 'string', 'max' => 6],
            [['districtName'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'districtId' => 'District ID',
            'districtCode' => 'District Code',
            'districtName' => 'District Name',
            'amphurId' => 'Amphur ID',
            'provinceId' => 'Province ID',
            'geographyId' => 'Geography ID',
        ];
    }
}
