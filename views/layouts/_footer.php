<footer class="bg-blue fg-white">
  <h2 class="text-center">חפשו אותנו גם ב:</h2>

  <?= \nurielmeni\socialConnect\SocialConnectWidget::widget([
    'size' => '32px',
    'color' => '#FFF',
    'items' => [
      'facebook' => [
        'url' => 'https://www.facebook.com/kivoon.biz',
      ],
      'linkedin' => [
        'url' => 'https://www.linkedin.com/company/kivoon---human-resources-placement-&-consultation-company/?viewAsMember=true',
      ],
      'instagram' => [
        'url' => 'https://instagram.com/kivoon.hr?utm_medium=copy_link'
      ],
      'whatsapp' => [
        'url' => 'https://wa.me/972508833111',
      ]
    ]
  ]) ?>

  <p>
    <a class="fg-white" href="https://niloosoft.com/he/">POWERED BY NILOOSOFT HUNTER EDGE</a>
  </p>
</footer>