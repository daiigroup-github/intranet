<?php

namespace frontend\modules\fitandfast\controllers;

use app\models\search\FitfastEmployeeSearch;
use frontend\models\FitfastTarget;
use Yii;
use frontend\models\FitfastEmployee;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Fitfast;

/**
 * ManageController implements the CRUD actions for FitfastEmployee model.
 */
class ManageController extends FitandfastMasterController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FitfastEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FitfastEmployee::find(),
            'sort' => ['attributes' => ['percent']]
        ]);

        $modelSearch = new FitfastEmployeeSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'modelSearch' => $modelSearch
        ]);
    }

    /**
     * Displays a single FitfastEmployee model.
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
     * Creates a new FitfastEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FitfastEmployee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->fitfastEmployeeId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FitfastEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->fitfastEmployeeId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FitfastEmployee model.
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
     * Finds the FitfastEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FitfastEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FitfastEmployee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Fitfast Target
     */

    public function actionViewFitfastTarget($id)
    {
        $fitfastTargetModel = FitfastTarget::findOne($id);
        return $this->render('view-fitfast-target', compact('fitfastTargetModel'));
    }

    public function actionUpdateFitfastTarget($id)
    {
        $fitfastTargetModel = FitfastTarget::findOne($id);

        if ($fitfastTargetModel->load(Yii::$app->request->post()) && $fitfastTargetModel->save()) {
            return $this->redirect(['view', 'id' => $fitfastTargetModel->fitfast->fitfastEmployeeId]);
        }

        return $this->render('update_fitfast_target', compact('fitfastTargetModel'));
    }

    public function actionCreateFitfastTarget($id)
    {
        $fitfastModel = Fitfast::findOne($id);
        $fitfastTargetModel = new FitfastTarget();
        $err = '';

        if(isset($_POST['FitfastTarget'])) {
            $fitfastTargetModel->attributes = $_POST['FitfastTarget'];

            //check duplicate month
            $fft = FitfastTarget::find()
                ->where('status=1 AND month=:month AND fitfastId=:fitfastId', [':month'=>$fitfastTargetModel->month, ':fitfastId'=>$fitfastModel->fitfastId])
                ->one();

            if(isset($fft)) {
                $err = 'Duplicate Month';
            } else {
                $fitfastTargetModel->fitfastId = $fitfastModel->fitfastId;
                $fitfastTargetModel->employeeId = $fitfastModel->employeeId;
                $fitfastTargetModel->createDateTime = $fitfastTargetModel->updateDateTime = new Expression('NOW()');

                if($fitfastTargetModel->save()) {
                    return $this->redirect(['view', 'id'=>$fitfastModel->fitfastEmployeeId]);
                }
            }
        }

        return $this->render('create_fitfast_target', compact('fitfastTargetModel', 'fitfastModel', 'err'));
    }

    /**
     * Fitfast
     */
    /**
     * Creates a new Fitfast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @param id = fitfastEmployeeId
     */
    public function actionCreateFitfast($id)
    {
        $fitfastModel = new Fitfast();
        $fitfastTargetModel = new FitfastTarget();
        $fitfastEmployeeModel = FitfastEmployee::findOne($id);

        $flag = false;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $fitfastModel->createDateTime = $fitfastModel->updateDateTime = new Expression('NOW()');
            $fitfastModel->employeeId = $fitfastEmployeeModel->employeeId;
            $fitfastModel->fitfastEmployeeId = $fitfastEmployeeModel->fitfastEmployeeId;
            if ($fitfastModel->load(Yii::$app->request->post()) && $fitfastModel->save()) {
                $fitfastId = Yii::$app->db->getLastInsertID();

                foreach ($_POST['FitfastTarget'] as $k => $v) {
                    if(empty($v['target']))
                        continue;

                    $fitfastTargetModel = new FitfastTarget();
                    $fitfastTargetModel->attributes = $v;
                    $fitfastTargetModel->month = $k;
                    $fitfastTargetModel->fitfastId = $fitfastId;
                    $fitfastTargetModel->employeeId = $fitfastEmployeeModel->employeeId;
                    $fitfastTargetModel->createDateTime = $fitfastTargetModel->updateDateTime = new Expression('NOW()');

                    if($fitfastTargetModel->save()) {
                        $flag = true;
                    } else {
                        $flag = false;
                        break;
                    }
                }
            }

            if ($flag) {
                $transaction->commit();
                return $this->redirect(['view', 'id' => $fitfastEmployeeModel->fitfastEmployeeId]);
            } else {
                $transaction->rollBack();
            }
        } catch
        (Exception $e) {
            $transaction->rollBack();
        }

        if ($fitfastModel->load(Yii::$app->request->post()) && $fitfastModel->save()) {
            return $this->redirect(['view', 'id' => $fitfastModel->fitfastId]);
        } else {
            return $this->render('create_fitfast', [
                'fitfastModel' => $fitfastModel,
                'fitfastTargetModel' => $fitfastTargetModel,
                'fitfastEmployeeModel' => $fitfastEmployeeModel
            ]);
        }
    }
}
