<?php

namespace frontend\models;

use Yii;
use \common\models\master\BranchMaster;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "branch".
 *
 * @property integer $branchId
 * @property integer $status
 * @property integer $branchValue
 * @property string $branchName
 * @property string $latitude
 * @property string $longitude
 * @property string $address
 * @property string $image
 * @property string $tel
class Branch extends \common\models\master\BranchMaster
*/
class Branch extends BranchMaster
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

    public function getAllBranch()
    {
        return ArrayHelper::map(
            Branch::find()->where('status=1')->orderBy('branchName')->all(),
            'branchId',
            'branchName'
        );
    }
}
