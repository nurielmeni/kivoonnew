<?php

namespace app\widgets\SumoSelect;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\sumoSelect\assets\SumoSelectAsset;

class SumoSelectWidget extends Widget
{


    public $name = '';
    public $options = [];
    public $multiple = false;
    public $config = [
        'placeholder' => 'בחר כאן',
        'csvDispCount' => 2,
        'captionFormat' => 'נבחרו',
        'captionFormatAllSelected' => 'כולם נבחרו!',
        'floatWidth' => 500,
        'forceCustomRendering' => false,
        'nativeOnDevice' => ['Android', 'BlackBerry', 'iPhone', 'iPad', 'iPod', 'Opera Mini', 'IEMobile', 'Silk'],
        'outputAsCSV' => false,
        'csvSepChar' => ';',
        'okCancelInMulti' => false,
        'isClickAwayOk' => false,
        'triggerChangeCombined' => true,
        'selectAll' => true,
        'search' => false,
        'searchText' => 'חפש...',
        'noMatch' => 'לא נמצא',
        'prefix' => '',
        'locale' =>  ['OK', 'בטל', 'בחר הכל'],
        'up' => 'false',
        'showTitle' => 'true',
    ];

    public function init()
    {
        parent::init();
        SumoSelectAsset::register(\Yii::$app->view);

        if (empty($this->name)) {
            $this->name = "sumo-select-" . random_int(0, 9999);
        }
    }

    public function run()
    {
        return $this->render('sumoSelect', [
            'name' => $this->name,
            'options' => $this->options,
            'multiple' => $this->multiple,
            'config' => $this->config,
        ]);
    }
}
