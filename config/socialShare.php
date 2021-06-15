<?php
return [
  'class' => \ymaker\social\share\configurators\Configurator::class,
  'socialNetworks' => [
    'facebook' => [
      'class' => \ymaker\social\share\drivers\Facebook::class,
      'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-facebook']),
      'options' => ['class' => 'fb'],
    ],
    'linkedIn' => [
      'class' => \ymaker\social\share\drivers\LinkedIn::class,
      'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-linkedin']),
      'options' => ['class' => 'in'],
    ],
    'whatsapp' => [
      'class' => app\helpers\SocialSahreWhatsapp::class,
      'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-whatsapp']),
      'options' => ['class' => 'wa'],
    ]
  ],
];
