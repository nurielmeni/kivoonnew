<?php

namespace app\widgets\SumoSelect;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\sumoSelect\assets\SumoSelectAsset;

class SumoSelectWidget extends Widget
{


    public $name = '';
    public $options = [];
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
            'config' => $this->config,
            // [
            //     'placeholder' => $this->placeholder,
            //     'csvDispCount' => $this->csvDispCount,
            //     'captionFormat' => $this->captionFormat,
            //     'captionFormatAllSelected' => $this->captionFormatAllSelected,
            //     'floatWidth' => $this->floatWidth,
            //     'forceCustomRendering' => $this->forceCustomRendering,
            //     'nativeOnDevice' => $this->nativeOnDevice,
            //     'outputAsCSV' => $this->outputAsCSV,
            //     'csvSepChar' => $this->csvSepChar,
            //     'okCancelInMulti' => $this->okCancelInMulti,
            //     'isClickAwayOk' => $this->isClickAwayOk,
            //     'triggerChangeCombined' => $this->triggerChangeCombined,
            //     'selectAll' => $this->selectAll,
            //     'search' => $this->search,
            //     'searchText' => $this->searchText,
            //     'noMatch' => $this->noMatch,
            //     'prefix' => $this->prefix,
            //     'locale' => $this->locale,
            //     'up' => $this->up,
            //     'showTitle' => $this->showTitle,
            // ]
        ]);
    }
}
