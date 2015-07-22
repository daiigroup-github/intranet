<?php

namespace frontend\models;

use Yii;
use \common\models\master\TheaterMaster;

/**
 * This is the model class for table "theater".
 *
 * @property string $theaterId
 * @property string $branchId
 * @property string $title
 * @property string $description
 * @property integer $seats
 * @property string $staffId
 * @property string $startTime
 * @property string $endTime
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class Theater extends \common\models\master\TheaterMaster
*/
class Theater extends TheaterMaster
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
