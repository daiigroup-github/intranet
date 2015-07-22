<?php

namespace frontend\models;

use Yii;
use \common\models\master\ExamChoiceMaster;

/**
 * This is the model class for table "exam_choice".
 *
 * @property string $examChoiceId
 * @property integer $status
 * @property string $title
 * @property string $value
class ExamChoice extends \common\models\master\ExamChoiceMaster
*/
class ExamChoice extends ExamChoiceMaster
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
