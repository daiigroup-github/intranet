<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentTypeCommentMaster;

/**
 * This is the model class for table "document_type_comment".
 *
 * @property integer $id
 * @property integer $documentTypeId
 * @property integer $employeeId
 * @property string $comment
 * @property string $createDateTime
class DocumentTypeComment extends \common\models\master\DocumentTypeCommentMaster
*/
class DocumentTypeComment extends DocumentTypeCommentMaster
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
