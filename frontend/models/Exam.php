<?php

namespace frontend\models;

use Yii;
use \common\models\master\ExamMaster;

/**
 * This is the model class for table "exam".
 *
 * @property integer $examId
 * @property integer $status
 * @property string $createDateTime
 * @property string $title
 * @property string $description
 * @property integer $creator
class Exam extends \common\models\master\ExamMaster
*/
class Exam extends ExamMaster
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
