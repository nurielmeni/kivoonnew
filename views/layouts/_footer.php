<?php

use yii\helpers\Url;
?>

<footer class="bg-blue fg-white">
  <h2 class="text-center">חפשו אותנו גם ב:</h2>

  <?= \nurielmeni\socialConnect\SocialConnectWidget::widget([
    'size' => '32px',
    'color' => '#FFF',
    'items' => [
      'whatsapp' => [
        'url' => 'https://wa.me/972508833111',
        'imgUrl' => Url::to('@web/images/social/whatsapp.svg')
      ],
      'facebook' => [
        'url' => 'https://www.facebook.com/kivoon.biz',
        'imgUrl' => Url::to('@web/images/social/facebook.svg')
      ],
      'linkedin' => [
        'url' => 'https://www.linkedin.com/company/kivoon---human-resources-placement-&-consultation-company/?viewAsMember=true',
        'imgUrl' => Url::to('@web/images/social/linkedin.svg')
      ],
      'instagram' => [
        'url' => 'https://instagram.com/kivoon.hr?utm_medium=copy_link',
        'imgUrl' => Url::to('@web/images/social/instagram.svg')
      ]
    ]
  ]) ?>

  <p>
    <a class="fg-white" href="https://niloosoft.com/he/">POWERED BY NILOOSOFT HUNTER EDGE</a>
  </p>
</footer>