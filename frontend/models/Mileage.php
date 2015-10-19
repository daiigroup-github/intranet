<?php

namespace frontend\models;

use Yii;
use \common\models\master\MileageMaster;

/**
 * This is the model class for table "mileage".
 *
 * @property integer $mileageId
 * @property integer $status
 * @property string $createDate
 * @property string $createTime
 * @property string $createDateTime
 * @property string $captureDateTime
 * @property integer $mileage
 * @property integer $mileageDiff
 * @property string $mileageDetail
 * @property string $mileageImage
 * @property string $latitude
 * @property string $longitude
 * @property integer $employeeId
 * @property string $employeeCode
 * @property integer $branchId
 * @property integer $projectId
class Mileage extends \common\models\master\MileageMaster
*/
class Mileage extends MileageMaster
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
}
