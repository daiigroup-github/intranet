<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentGroupMaster;

/**
 * This is the model class for table "document_group".
 *
 * @property string $documentGroupId
 * @property string $documentGroupName
 * @property integer $status
class DocumentGroup extends \common\models\master\DocumentGroupMaster
*/
class DocumentGroup extends DocumentGroupMaster
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
