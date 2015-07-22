<?php

namespace frontend\models;

use Yii;
use \common\models\master\ElearningMaster;

/**
 * This is the model class for table "elearning".
 *
 * @property integer $elearningId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $title
 * @property string $description
 * @property string $pdfFile
 * @property integer $numberOfQuestion
 * @property integer $parentId
class Elearning extends \common\models\master\ElearningMaster
*/
class Elearning extends ElearningMaster
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
