<?php

namespace app\widgets\sumoSelect\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SumoSelectAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/sumoSelect/assets';
    public $css = [
        'css/sumoSelect.css',
    ];
    public $js = [
        'js/sumoSelect.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
