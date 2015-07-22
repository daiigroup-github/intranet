<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafMediaMaster;

/**
 * This is the model class for table "qsaf_media".
 *
 * @property integer $mediaId
 * @property integer $status
 * @property string $name
 * @property integer $requireOther
class QsafMedia extends \common\models\master\QsafMediaMaster
*/
class QsafMedia extends QsafMediaMaster
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
