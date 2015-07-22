<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentControlTypeMaster;

/**
 * This is the model class for table "document_control_type".
 *
 * @property integer $documentControlTypeId
 * @property string $documentControlTypeName
class DocumentControlType extends \common\models\master\DocumentControlTypeMaster
*/
class DocumentControlType extends DocumentControlTypeMaster
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
