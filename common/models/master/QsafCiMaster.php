<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_ci".
 *
 * @property integer $ciId
 * @property string $createDateTime
 * @property integer $customerId
 * @property integer $mediaId
 * @property string $mediaOther
 * @property integer $productCategoryId
 * @property integer $restroom
 * @property integer $bedroom
 * @property integer $maidroom
 * @property integer $tabernacle
 * @property integer $kitchen
 * @property integer $garage
 * @property integer $area
 * @property integer $buildingType
 * @property integer $floorType
 * @property string $address
 * @property integer $landArea
 * @property integer $landWidth
 * @property integer $landDepth
 * @property integer $roadWidth
 * @property integer $pileType
 * @property integer $constructionTime
 * @property integer $budgetType
 * @property integer $payType
 * @property string $remarks
 * @property integer $dome
 * @property integer $swimmingPool
 * @property integer $fishPond
 * @property integer $livingroom
 * @property integer $diningroom
 * @property integer $storeroom
 * @property integer $studio
 */
class QsafCiMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_ci';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createDateTime', 'customerId', 'mediaId', 'productCategoryId', 'restroom', 'bedroom', 'garage', 'buildingType', 'floorType'], 'required'],
            [['customerId', 'mediaId', 'productCategoryId', 'restroom', 'bedroom', 'maidroom', 'tabernacle', 'kitchen', 'garage', 'area', 'buildingType', 'floorType', 'landArea', 'landWidth', 'landDepth', 'roadWidth', 'pileType', 'constructionTime', 'budgetType', 'payType', 'dome', 'swimmingPool', 'fishPond', 'livingroom', 'diningroom', 'storeroom', 'studio'], 'integer'],
            [['address', 'remarks'], 'string'],
            [['createDateTime'], 'string', 'max' => 45],
            [['mediaOther'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ciId' => 'Ci ID',
            'createDateTime' => 'Create Date Time',
            'customerId' => 'Customer ID',
            'mediaId' => 'Media ID',
            'mediaOther' => 'Media Other',
            'productCategoryId' => 'Product Category ID',
            'restroom' => 'Restroom',
            'bedroom' => 'Bedroom',
            'maidroom' => 'Maidroom',
            'tabernacle' => 'Tabernacle',
            'kitchen' => 'Kitchen',
            'garage' => 'Garage',
            'area' => 'Area',
            'buildingType' => 'Building Type',
            'floorType' => 'Floor Type',
            'address' => 'Address',
            'landArea' => 'Land Area',
            'landWidth' => 'Land Width',
            'landDepth' => 'Land Depth',
            'roadWidth' => 'Road Width',
            'pileType' => 'Pile Type',
            'constructionTime' => 'Construction Time',
            'budgetType' => 'Budget Type',
            'payType' => 'Pay Type',
            'remarks' => 'Remarks',
            'dome' => 'Dome',
            'swimmingPool' => 'Swimming Pool',
            'fishPond' => 'Fish Pond',
            'livingroom' => 'Livingroom',
            'diningroom' => 'Diningroom',
            'storeroom' => 'Storeroom',
            'studio' => 'Studio',
        ];
    }
}
