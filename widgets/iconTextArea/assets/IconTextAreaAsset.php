<?php

namespace app\widgets\iconTextArea\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class IconTextAreaAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/iconTextArea/assets';
    public $css = [
        'css/iconTextArea.css',
    ];
}
