<?php

namespace frontend\controllers;

use common\controllers\MasterController;
class PortalController extends MasterController
{
    public $layout = 'portal';
    public function actionIndex()
    {
        $webs = [
            'Ginza Home'=>'www.ginzahome.com',
            'Ginza Designs'=>'www.ginzadesigns.com',
            'Fenzer'=>'www.fenzer.biz',
            'Atech Window'=>'www.atechwindow.com',
            'daiiBuy'=>'www.daiibuy.com',
            'Daii Group'=>'www.daiigroup.com'
        ];
        return $this->render('index', compact('webs'));
    }

}
