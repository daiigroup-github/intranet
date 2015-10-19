<?php

namespace frontend\models;

use Yii;
use \common\models\master\ElearningExamQuestionMaster;

/**
 * This is the model class for table "elearning_exam_question".
 *
 * @property integer $questionId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property string $elearningId
class ElearningExamQuestion extends \common\models\master\ElearningExamQuestionMaster
*/
class ElearningExamQuestion extends ElearningExamQuestionMaster
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
