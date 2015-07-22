<?php

namespace frontend\models;

use Yii;
use \common\models\master\ProvinceMaster;

/**
 * This is the model class for table "province".
 *
 * @property integer $provinceId
 * @property string $provinceName
 * @property integer $geographyId
 * @property integer $status
class Province extends \common\models\master\ProvinceMaster
*/
class Province extends ProvinceMaster
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
    public function getAmphurs()
    {
        return $this->hasMany(Amphur::className(), ['amphurId'=>'amphurId']);
    }

    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['amphurId'=>'amphurId']);
    }

}
