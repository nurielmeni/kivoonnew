<?php

use yii\helpers\Url;
?>

<section class="social-share-header bg-blue fg-white xs-down">

  <h2 class="text-center">דברו איתנו!</h2>
  <?= \nurielmeni\socialConnect\SocialConnectWidget::widget([
    'linkClass' => 'bg-bordered-circle',
    'size' => '48px',
    'color' => '#5378ae',
    'items' => [
      'facebook' => [
        'url' => 'https://www.facebook.com/kivoon.biz',
        'imgUrl' => Url::to('@web/images/social/facebook-header.svg')
      ],
      'whatsapp' => [
        'url' => 'https://wa.me/972508833111',
        'imgUrl' => Url::to('@web/images/social/whatsapp-header.svg')
      ],
      'linkedin' => [
        'url' => 'https://www.linkedin.com/company/kivoon---human-resources-placement-&-consultation-company/?viewAsMember=true',
        'imgUrl' => Url::to('@web/images/social/linkedin-header.svg')
      ],
      'instagram' => [
        'url' => 'https://instagram.com/kivoon.hr?utm_medium=copy_link',
        'imgUrl' => Url::to('@web/images/social/instagram-header.svg')
      ],

    ]
  ]) ?>

</section>