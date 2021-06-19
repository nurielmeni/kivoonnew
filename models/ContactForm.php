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

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [['content'], 'required']
            ]
        );
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'content' => Yii::t('app', 'Content')
            ]
        );
    }


    /**
     * Sends an contact email.
     * @param content $email the target email address
     * @param subject $email the target email address
     * @return bool whether email sent successfully
     */
    public function contactMail($content, $subject)
    {
        $subject = $subject ? $subject : 'אתר משרות כיןןן - טופס יצירת קשר';
        return Yii::$app->mailer->compose('contact', ['content' => $content, 'model' => $this->attributes()])
            ->setTo($this->email)
            ->setBcc(Yii::$app->params['bccMail'])
            ->setFrom([Yii::$app->params['contact']['fromMail'] => Yii::$app->params['fromName']])
            ->setSubject($subject)
            ->setHtmlBody($content)
            ->setTextBody(strip_tags($content))
            ->send();
    }
}
