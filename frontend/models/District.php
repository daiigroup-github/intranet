<?php

namespace frontend\models;

use Yii;
use \common\models\master\DistrictMaster;

/**
 * This is the model class for table "district".
 *
 * @property integer $districtId
 * @property string $districtCode
 * @property string $districtName
 * @property integer $amphurId
 * @property integer $provinceId
 * @property integer $geographyId
class District extends \common\models\master\DistrictMaster
*/
class District extends DistrictMaster
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

    /**
     * relation
     */
    public function getAmphur()
    {
        return $this->hasOne(Amphur::className(), ['amphurId'=>'amphurId']);
    }

    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['provinceId'=>'provinceId']);
    }
}
