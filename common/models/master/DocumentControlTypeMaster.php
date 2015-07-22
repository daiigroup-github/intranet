<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_control_type".
 *
 * @property integer $documentControlTypeId
 * @property string $documentControlTypeName
 */
class DocumentControlTypeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_control_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentControlTypeName'], 'required'],
            [['documentControlTypeName'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentControlTypeId' => 'Document Control Type ID',
            'documentControlTypeName' => 'Document Control Type Name',
        ];
    }
}
