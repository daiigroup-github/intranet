<?php

namespace frontend\models;

use Yii;
use \common\models\master\ExamQuestionExamChoiceMaster;

/**
 * This is the model class for table "exam_question_exam_choice".
 *
 * @property string $id
 * @property integer $status
 * @property integer $examQuestionId
 * @property string $examChoiceId
class ExamQuestionExamChoice extends \common\models\master\ExamQuestionExamChoiceMaster
*/
class ExamQuestionExamChoice extends ExamQuestionExamChoiceMaster
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
