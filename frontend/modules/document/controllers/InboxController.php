<?php

namespace frontend\modules\document\controllers;

use frontend\models\Document;
use Yii;
use frontend\models\search\DocumentSearch;

class InboxController extends \common\controllers\MasterController
{
    public function actionIndex()
    {
        $modelSearch = new DocumentSearch();
        $dataProvider = $modelSearch->searchInbox(Yii::$app->request->queryParams);
        return $this->render('index', compact('dataProvider', 'modelSearch'));
    }

    public function actionView($id)
    {
        $model = Document::findOne($id);

        if(isset($model->customView) && !empty($model->customView)) {
            //have custom view
        } else {

        }

        return $this->render('view', compact('model'));
    }
}
