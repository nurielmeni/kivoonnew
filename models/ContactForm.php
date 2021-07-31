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
    public $email;

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
    public function contactMail($subject = null)
    {
        $subject = $subject ? $subject : Yii::t('app', 'Kivoon job site - contact form');
        return Yii::$app->mailer->compose('contact', ['model' => $this])
            ->setTo($this->email)
            ->setBcc(Yii::$app->params['bccMail'])
            ->setFrom(Yii::$app->params['contactFrom'])
            ->setSubject($subject)
            ->send();
    }
}
