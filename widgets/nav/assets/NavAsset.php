<?php

namespace app\widgets\nav\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class NavAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/nav/assets';
    public $css = [
        'css/nav.css',
    ];

    public $js = [
        'css/nav.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
