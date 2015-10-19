<?php

namespace frontend\models;

use Yii;
use \common\models\master\FitfastMaster;

/**
 * This is the model class for table "fitfast".
 *
 * @property integer $fitfastId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $fitfastEmployeeId
 * @property integer $employeeId
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property integer $halfS
 * @property integer $S
 * @property integer $SS
 * @property integer $F
class Fitfast extends \common\models\master\FitfastMaster
*/
class Fitfast extends FitfastMaster
{
    const TYPE_PERFORMANCE = 1;
    const TYPE_IMPLEMENT = 2;

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
    public function getFitfastEmployee()
    {
        return $this->hasOne(FitfastEmployee::className(), ['fitfastEmployeeId'=>'fitfastEmployeeId']);
    }

    public function getFitfastTargets()
    {
        return $this->hasMany(FitfastTarget::className(), ['fitfastId'=>'fitfastId']);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId'=>'employeeId']);
    }
    //relation

    public function getTypeArray()
    {
        return [
            self::TYPE_PERFORMANCE=>'Performance',
            self::TYPE_IMPLEMENT=>'Implement',
        ];
    }

    public function getTypeText()
    {
        $typeArray = $this->typeArray;

        return $typeArray[$this->type];
    }
}
