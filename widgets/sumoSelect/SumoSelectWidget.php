<?php

namespace app\widgets\SumoSelect;

use yii\base\Widget;
use yii\helpers\Url;
use app\widgets\sumoSelect\assets\SumoSelectAsset;

class SumoSelectWidget extends Widget
{


    public $name = 'sumo-select';
    public $placeholder = 'בחר כאן';
    public $csvDispCount = 2;
    public $captionFormat = '{0} נבחרו';
    public $captionFormatAllSelected = '{0} כולם נבחרו!';
    public $floatWidth = 500;
    public $forceCustomRendering = false;
    public $nativeOnDevice = ['Android', 'BlackBerry', 'iPhone', 'iPad', 'iPod', 'Opera Mini', 'IEMobile', 'Silk'];
    public $outputAsCSV = false;
    public $csvSepChar = ';';
    public $okCancelInMulti = false;
    public $isClickAwayOk = false;
    public $triggerChangeCombined = true;
    public $selectAll = true;
    public $search = false;
    public $searchText = 'חפש...';
    public $noMatch = 'לא נמצא "{0}"';
    public $prefix = '';
    public $locale =  ['OK', 'בטל', 'בחר הכל'];
    public $up = 'false';
    public $showTitle = 'true';

    public function init()
    {
        parent::init();
        SumoSelectAsset::register(\Yii::$app->view);
    }

    public function run()
    {
        return $this->render('sumoSelect', [
            'name' => $this->name,
            'placeholder' => $this->placeholder,
            'csvDispCount' => $this->csvDispCount,
            'captionFormat' => $this->captionFormat,
            'captionFormatAllSelected' => $this->captionFormatAllSelected,
            'floatWidth' => $this->floatWidth,
            'forceCustomRendering' => $this->forceCustomRendering,
            'nativeOnDevice' => $this->nativeOnDevice,
            'outputAsCSV' => $this->outputAsCSV,
            'csvSepChar' => $this->csvSepChar,
            'okCancelInMulti' => $this->okCancelInMulti,
            'isClickAwayOk' => $this->isClickAwayOk,
            'triggerChangeCombined' => $this->triggerChangeCombined,
            'selectAll' => $this->selectAll,
            'search' => $this->search,
            'searchText' => $this->searchText,
            'noMatch' => $this->noMatch,
            'prefix' => $this->prefix,
            'locale' => $this->locale,
            'up' => $this->up,
            'showTitle' => $this->showTitle,
        ]);
    }
}
