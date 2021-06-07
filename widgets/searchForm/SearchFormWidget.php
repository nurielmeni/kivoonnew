<?php

namespace app\widgets\SearchForm;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\searchForm\assets\SearchFormAsset;

class SearchFormWidget extends Widget
{


    public $name = 'submit-popup';
    public $cssClass = '';
    public $resultsWrapperElementId = 'search-results';
    public $applyUrl;

    public function init()
    {
        parent::init();
        SearchFormAsset::register(\Yii::$app->view);

        if (empty($this->applyUrl)) {
            $this->applyUrl = Url::to('site/apply');
        }
    }

    public function run()
    {
        return $this->render('searchForm', [
            'name' => $this->name,
            'class' => $this->cssClass,
            'resultsWrapperElementId' => $this->resultsWrapperElementId,
            'applyUrl' => $this->applyUrl,
        ]);
    }
}
