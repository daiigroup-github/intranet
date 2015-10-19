<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "website".
 *
 * @property integer $websiteId
 * @property string $name
 * @property string $description
 * @property string $url
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class WebsiteMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'website';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['type', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name', 'url'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'websiteId' => 'Website ID',
            'name' => 'Name',
            'description' => 'Description',
            'url' => 'Url',
            'type' => 'Type',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
