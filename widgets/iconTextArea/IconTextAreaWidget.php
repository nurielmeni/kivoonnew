<?php

namespace app\widgets\IconTextArea;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\iconTextArea\assets\IconTextAreaAsset;

class IconTextAreaWidget extends Widget
{


    public $name = 'search-form';
    public $cssClass = '';
    public $size = 44;
    public $image = '';
    public $title = '';
    public $content = '';

    public function init()
    {
        parent::init();
        IconTextAreaAsset::register(\Yii::$app->view);
    }

    public function run()
    {
        return $this->render('iconTextArea', [
            'name' => $this->name,
            'cssClass' => $this->cssClass,
            'size' => $this->size,
            'image' => $this->image,
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}
