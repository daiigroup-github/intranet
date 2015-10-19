<?php

namespace frontend\models;

use Yii;
use \common\models\master\QtechProcessSubImageMaster;

/**
 * This is the model class for table "qtech_process_sub_image".
 *
 * @property integer $qtechProcessSubImageId
 * @property integer $status
 * @property string $createDateTime
 * @property string $imageDate
 * @property string $imageTime
 * @property string $qtechProcessSubImageName
 * @property string $qtechProcessSubImageDetail
 * @property integer $qtechProcessId
 * @property string $latitude
 * @property string $longitude
 * @property string $direction
 * @property string $identifier
 * @property integer $labour
class QtechProcessSubImage extends \common\models\master\QtechProcessSubImageMaster
*/
class QtechProcessSubImage extends QtechProcessSubImageMaster
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
