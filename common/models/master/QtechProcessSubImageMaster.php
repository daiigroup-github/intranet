<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qtech_process_sub_image".
 *
 * @property integer $qtechProcessSubImageId
 * @property integer $status
 * @property string $createDateTime
 * @property string $imageDate
 * @property string $imageTime
 * @property string $qtechProcessSubImageName
 * @property string $qtechProcessSubImageDetail
 * @property integer $qtechProcessId
 * @property string $latitude
 * @property string $longitude
 * @property string $direction
 * @property string $identifier
 * @property integer $labour
 */
class QtechProcessSubImageMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtech_process_sub_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'qtechProcessId', 'labour'], 'integer'],
            [['createDateTime', 'imageDate', 'imageTime', 'qtechProcessSubImageName', 'qtechProcessSubImageDetail', 'qtechProcessId', 'latitude', 'longitude', 'direction', 'identifier', 'labour'], 'required'],
            [['createDateTime', 'imageDate', 'imageTime'], 'safe'],
            [['qtechProcessSubImageName'], 'string', 'max' => 255],
            [['qtechProcessSubImageDetail'], 'string', 'max' => 150],
            [['latitude', 'longitude', 'direction'], 'string', 'max' => 20],
            [['identifier'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qtechProcessSubImageId' => 'Qtech Process Sub Image ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'imageDate' => 'Image Date',
            'imageTime' => 'Image Time',
            'qtechProcessSubImageName' => 'Qtech Process Sub Image Name',
            'qtechProcessSubImageDetail' => 'Qtech Process Sub Image Detail',
            'qtechProcessId' => 'Qtech Process ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'direction' => 'Direction',
            'identifier' => 'Identifier',
            'labour' => 'Labour',
        ];
    }
}
