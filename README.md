# intranet2

### Extends
1. ทุก Controller ให้ extends common\controllers\MasterController
2. Model ที่สร้างจากฐานข้อมูลให้สร้างชือ TableNameMaster ไว้ที่ \common\models\master  
  2.1. frontend\models : สร้าง Model ชื่อ TableName extends \common\models\master\TableNameMaster  
  2.2. backend\models : สร้าง Model ชื่อ TableName extends \frontend\models\TableName  

### Config files
1. ค่า config ต่างๆ ที่ใช้ในการ Dev ในเครื่องให้กำหนดไว้ที่ main-local.php, params-local.php ไฟล์ที่ตามด้วย -local.php จะถูกลบเมื่อนำขึ้น Production  

### Gii
/frontend/config/main-local.php
```php
if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'model'=> [
                'class' => 'yii\gii\generators\model\Generator',
                'templates'=>['extends'=>'@common/gii/templates/model/extends']
            ]
        ],
        'allowedIPs'=>['192.168.56.1'],
    ];
}
```

### Themes
/frontend/config/main.php
```php
components => [
...
  'view' =>[
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/pixel-admin'],
                'baseUrl'   => '@web'
            ]
        ],
]
```
