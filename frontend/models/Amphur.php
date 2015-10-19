<?php

namespace frontend\models;

use Yii;
use \common\models\master\AmphurMaster;

/**
 * This is the model class for table "amphur".
 *
 * @property integer $amphurId
 * @property string $amphurCode
 * @property string $amphurName
 * @property integer $geographyId
 * @property integer $provinceId
class Amphur extends \common\models\master\AmphurMaster
*/
class Amphur extends AmphurMaster
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
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['provinceId'=>'provinceId']);
    }

    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['amphurId'=>'amphurId']);
    }
}
