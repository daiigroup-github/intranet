<?php

namespace frontend\models;

use Yii;
use \common\models\master\ExamQuestionMaster;

/**
 * This is the model class for table "exam_question".
 *
 * @property integer $examQuestionId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property integer $questionType
 * @property integer $startRange
 * @property integer $stopRange
 * @property string $weight
class ExamQuestion extends \common\models\master\ExamQuestionMaster
*/
class ExamQuestion extends ExamQuestionMaster
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
