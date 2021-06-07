<?php

namespace app\widgets\searchForm\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SearchFormAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/searchForm/assets';
    public $css = [
        'css/loader.css',
        'css/searchForm.css',
    ];
    public $js = [
        'js/searchForm.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
