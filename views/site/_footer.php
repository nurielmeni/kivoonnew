<footer class="bg-blue fg-white">
  <h2 class="text-center">חפשו אותנו גם ב:</h2>

  <?= \nurielmeni\socialConnect\SocialConnectWidget::widget([
    'size' => '32px',
    'color' => '#FFF',
    'items' => [
      'facebook' => [
        'url' => '#',
      ],
      'linkedin' => [
        'url' => '#',
      ],
      'whatsapp' => [
        'url' => '#',
      ]
    ]
  ]) ?>

  <p>
    <a class="fg-white" href="https://niloosoft.com/he/">POWERED BY NILOOSOFT HUNTER EDGE</a>
  </p>
</footer>