<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\iconTextArea\IconTextAreaWidget;

$this->title = Yii::$app->name;

?>

<?= $this->render('_header') ?>


<div class="arroe-divider bg-blue w-100 xs-up"></div>

<?= IconTextAreaWidget::widget([
  'name' => 'meet-us', 
  'image' => Url::to('@web/images/icons/info.svg', true),
  'title' => 'Title test',
  'content' => '<p>This is my content</p>'
  ]) ?>