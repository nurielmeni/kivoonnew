<section class="social-share-header bg-blue fg-white xs-down">

  <h2 class="text-center">דברו איתנו!</h2>
  <?= \nurielmeni\socialConnect\socialConnectWidget::widget([
    'linkClass' => 'bg-bordered-circle',
    'size' => '28px',
    'color' => '#5378ae',
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

</section>