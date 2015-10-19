<?php

namespace frontend\models;

use Yii;
use \common\models\master\ExamExamQuestionMaster;

/**
 * This is the model class for table "exam_exam_question".
 *
 * @property string $id
 * @property integer $status
 * @property integer $examId
 * @property integer $examQuestionId
class ExamExamQuestion extends \common\models\master\ExamExamQuestionMaster
*/
class ExamExamQuestion extends ExamExamQuestionMaster
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
