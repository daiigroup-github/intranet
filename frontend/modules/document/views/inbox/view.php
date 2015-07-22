<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->title = $model->documentType->documentTypeName . ' : #' . $model->documentCode;
$this->params['breadcrumbs'][] = ['label'=>'Inbox', 'url'=>['/document/inbox']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="document-view">
   <?=$this->render('_document_view_creator', compact('model'))?>

   <?=$this->render('_document_view_history', compact('model'))?>
</div>
