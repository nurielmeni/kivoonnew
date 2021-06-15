<?php

namespace app\models;

use Yii;
use app\models\BaseForm;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends BaseForm
{
    public $content;
}
