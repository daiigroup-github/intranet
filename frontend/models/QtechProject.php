<?php

namespace frontend\models;

use Yii;
use \common\models\master\QtechProjectMaster;

/**
 * This is the model class for table "qtech_project".
 *
 * @property integer $qtechProjectId
 * @property integer $status
 * @property string $createDateTime
 * @property integer $productCatId
 * @property integer $productValue
 * @property string $projectName
 * @property string $projectDetail
 * @property double $projectPrice
 * @property string $projectImageName
 * @property string $projectAddress
 * @property integer $customerId
 * @property integer $engineerId
 * @property integer $saleId
 * @property string $startDate
 * @property string $endDate
 * @property string $latitude
 * @property string $longitude
 * @property integer $branchValue
class QtechProject extends \common\models\master\QtechProjectMaster
*/
class QtechProject extends QtechProjectMaster
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
