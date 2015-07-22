<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "rights".
 *
 * @property string $itemname
 * @property integer $type
 * @property integer $weight
 */
class RightsMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemname', 'type', 'weight'], 'required'],
            [['type', 'weight'], 'integer'],
            [['itemname'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'itemname' => 'Itemname',
            'type' => 'Type',
            'weight' => 'Weight',
        ];
    }
}
