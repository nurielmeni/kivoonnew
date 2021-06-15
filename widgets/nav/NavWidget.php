<?php

namespace app\widgets\Nav;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\nav\assets\NavAsset;

class NavWidget extends Widget
{


    public $name = 'nav-id';
    public $cssClass = '';
    public $size = 44;
    /**
     * [
     *  'image' => 'abs url',
     *  'href' => 'href link' (on click),
     *  'label' => 'label text'
     * ]
     */
    public $items = [];

    public function init()
    {
        parent::init();
        NavAsset::register(\Yii::$app->view);
    }

    public function run()
    {
        return $this->render('nav', [
            'name' => $this->name,
            'cssClass' => $this->cssClass,
            'size' => $this->size,
            'items' => $this->items,
        ]);
    }
}
