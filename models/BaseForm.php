<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class BaseForm extends Model
{
    public $firstname;
    public $lastname;
    public $email;

    protected $tmpFiles = [];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['firstname', 'lastname', 'email'], 'required'],
            [['firstname', 'lastname'], 'filter', 'filter' => 'trim', 'skipOnArray' => true]
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('app', 'First Name'),
            'lastname' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
