<?php

namespace frontend\models;

use Yii;
use \common\models\master\ElearningExamItemMaster;

/**
 * This is the model class for table "elearning_exam_item".
 *
 * @property string $id
 * @property integer $elearningExamId
 * @property integer $questionId
 * @property integer $choiceId
 * @property integer $isCorrect
class ElearningExamItem extends \common\models\master\ElearningExamItemMaster
*/
class ElearningExamItem extends ElearningExamItemMaster
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
