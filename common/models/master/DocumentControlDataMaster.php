<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_control_data".
 *
 * @property integer $documentControlDataId
 * @property string $documentControlDataName
 * @property string $dataModel
 * @property string $dataMethod
 * @property string $fieldId
 * @property string $fieldValue
 */
class DocumentControlDataMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_control_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentControlDataName'], 'required'],
            [['documentControlDataName'], 'string', 'max' => 100],
            [['dataModel', 'dataMethod'], 'string', 'max' => 1000],
            [['fieldId', 'fieldValue'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentControlDataId' => 'Document Control Data ID',
            'documentControlDataName' => 'Document Control Data Name',
            'dataModel' => 'Data Model',
            'dataMethod' => 'Data Method',
            'fieldId' => 'Field ID',
            'fieldValue' => 'Field Value',
        ];
    }
}
