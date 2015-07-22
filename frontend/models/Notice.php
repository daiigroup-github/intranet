<?php

namespace frontend\models;

use Yii;
use \common\models\master\NoticeMaster;

/**
 * This is the model class for table "notice".
 *
 * @property integer $noticeId
 * @property string $title
 * @property string $headline
 * @property string $description
 * @property string $imageUrl
 * @property integer $employeeId
 * @property integer $status
 * @property integer $noticeTypeId
 * @property string $createDateTime
 * @property string $updateDateTime
class Notice extends \common\models\master\NoticeMaster
*/
class Notice extends NoticeMaster
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
