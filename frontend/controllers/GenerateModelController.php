<?php

namespace frontend\controllers;

use Yii;
use yii\gii\generators\model\Generator;

class GenerateModelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $connection = \Yii::$app->db;

        $model = $connection->createCommand('SHOW TABLES');
        $tables = $model->queryAll();

        foreach ($tables as $table) {
            foreach ($table as $tableName) {
                $tn = explode('_', $tableName);
                $tn = array_map('ucwords', $tn);
                $modelClass = implode('', $tn);

                //Master Model
                $generator = new Generator();
                $generator->tableName = $tableName;
                $generator->modelClass = $modelClass.'Master';
                $generator->ns = 'common\models\master';
                $generator->baseClass = 'common\models\MasterModel';
                $files = $generator->generate();
                $answers = [];
                foreach ($files as $file) {
                    $answers[$file->id] = 1;
                }
                $result = '';

                //Extend Model
                $generator2 = new Generator();
                $generator2->tableName = $tableName;
                $generator2->modelClass = $modelClass;
                $generator2->ns = 'frontend\models';
                $generator2->baseClass = $generator->ns.'\\'.$generator->modelClass;
                $generator2->templates['extends'] = Yii::getAlias('@common/gii/templates/model/extends');
                $generator2->template = 'extends';
                $files2 = $generator2->generate();
                $answers2 = [];
                foreach ($files2 as $file2) {
                    $answers2[$file2->id] = 1;
                }
                $result2 = '';

                if($generator->save($files, $answers, $result)){
                    echo '<p>';
                    echo 'tableName:' . $generator->tableName . ', modelClass:'.$generator->modelClass .'<br />';

                    //check file exist
                    if(!file_exists(Yii::getAlias('@' . str_replace('\\', '/', $generator2->ns)).'/'.$generator2->modelClass.'.php')) {
                        if ($generator2->save($files2, $answers2, $result2)) {
                            echo Yii::getAlias('@' . str_replace('\\', '/', $generator2->ns)) . '/' . $generator2->modelClass . '.php<br />';
                            echo 'tableName:' . $generator2->tableName . ', modelClass:' . $generator2->modelClass . '<br />';
                        }
                    }
                    echo '</p>';
                } else {
                    break;
                }
            }
        }
    }

}
