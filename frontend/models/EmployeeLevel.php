<?php

namespace frontend\models;

use Yii;
use \common\models\master\EmployeeLevelMaster;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee_level".
 *
 * @property integer $employeeLevelId
 * @property integer $status
 * @property integer $level
 * @property string $description
class EmployeeLevel extends \common\models\master\EmployeeLevelMaster
*/
class EmployeeLevel extends EmployeeLevelMaster
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

    public function getAllEmployeeLevel()
    {
        return ArrayHelper::map(
            EmployeeLevel::find()->where('status=1')->orderBy('level')->all(),
            'employeeLevelId',
            'description'
        );
    }
}
