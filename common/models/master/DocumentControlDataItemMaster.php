<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_control_data_item".
 *
 * @property integer $documentControlDataItemId
 * @property integer $documentControlDataId
 * @property integer $documentControlDataItemUseId
 * @property string $documentControlDataItemValue
 */
class DocumentControlDataItemMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_control_data_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentControlDataId', 'documentControlDataItemValue'], 'required'],
            [['documentControlDataId', 'documentControlDataItemUseId'], 'integer'],
            [['documentControlDataItemValue'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentControlDataItemId' => 'Document Control Data Item ID',
            'documentControlDataId' => 'Document Control Data ID',
            'documentControlDataItemUseId' => 'Document Control Data Item Use ID',
            'documentControlDataItemValue' => 'Document Control Data Item Value',
        ];
    }
}
