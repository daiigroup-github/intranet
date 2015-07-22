<?php

namespace frontend\models;

use Yii;
use \common\models\master\ElearningExamChoiceMaster;

/**
 * This is the model class for table "elearning_exam_choice".
 *
 * @property integer $choiceId
 * @property integer $isCorrect
 * @property string $title
 * @property string $description
 * @property integer $questionId
class ElearningExamChoice extends \common\models\master\ElearningExamChoiceMaster
*/
class ElearningExamChoice extends ElearningExamChoiceMaster
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
