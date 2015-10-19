<?php

namespace frontend\controllers;

use app\models\search\EmployeeSearch;
use common\controllers\MasterController;
use common\models\User;
use Yii;
use frontend\models\Employee;
use yii\base\Object;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends MasterController
{
    public function behaviors()
    {
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];

        return array_merge(parent::behaviors(), $behaviors);
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find()->where('status=:status', [':status' => 1]),
        ]);

        $dataProvider->sort = false;

        $this->writeToFile('/tmp/emp', print_r(Yii::$app->request->queryParams, true));

        $model = new Employee();
        $modelSearch = new EmployeeSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('dataProvider', 'model', 'modelSearch'));
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())) {
            $model->employeeCode = $model->generateEmployeeCode();
            $model->username = $model->generateUsername($model->fnEn, $model->lnEn);
            $model->password = $model->hashPassword();
            $model->createDateTime = $model->updateDateTime = new Expression('NOW()');
//            $model->proDate = date('Y-m-d', strtotime($model->startDate, '+90 day'));

            echo '<br /><br /><br /><br /><br /><br />';
            print_r($model->attributes);

            if(!$model->validate()) {
                echo '<br /><br /><br /><br /><br /><br />';
                print_r($model->errors);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->employeeId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
