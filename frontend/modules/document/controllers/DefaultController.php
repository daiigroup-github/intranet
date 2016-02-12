<?php

namespace frontend\modules\document\controllers;

use frontend\models\CompanyDivision;
use frontend\models\DocumentType;
use yii\web\Controller;

class DefaultController extends \common\controllers\MasterController
{
    public function actionIndex()
    {
        $documentTypeModels = DocumentType::find()->where('status=1')->all();
        $companyDivisionModels = CompanyDivision::find()->where('status=1')->orderBy('description')->all();

        return $this->render('index', compact('documentTypeModels', 'companyDivisionModels'));
    }
}
