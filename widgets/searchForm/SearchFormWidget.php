<?php

namespace app\widgets\SearchForm;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\searchForm\assets\SearchFormAsset;

class SearchFormWidget extends Widget
{
    const SELECT = 'select';
    const TEXT = 'text';
    const SUBMIT = 'submit';

    public $name = 'search-form';
    public $cssClass = '';
    public $resultsWrapperElementId = 'search-results';
    public $applyResultsWrapperSelector = 'apply-results';
    public $applyUrl;
    public $searchUrl;
    /**
     * type: [select, text, submit]
     * content: [options: [multiple: Bool, options: Array, name: String, placeholder: String], name: String, name: String]
     */
    public $serachFields = [];

    public function init()
    {
        parent::init();
        SearchFormAsset::register(\Yii::$app->view);

        if (empty($this->applyUrl)) {
            $this->applyUrl = Url::to('site/apply');
        }

        if (empty($this->searchUrl)) {
            $this->searchUrl = Url::to('site/search');
        }
    }

    public function run()
    {
        return $this->render('searchForm', [
            'name' => $this->name,
            'cssClass' => $this->cssClass,
            'resultsWrapperElementId' => $this->resultsWrapperElementId,
            'applyResultsWrapperSelector' => $this->applyResultsWrapperSelector,
            'applyUrl' => $this->applyUrl,
            'searchUrl' => $this->searchUrl,
            'serachFields' => $this->serachFields,
        ]);
    }
}
