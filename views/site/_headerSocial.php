<section class="social-share-header bg-blue fg-white xs-down">

  <h2 class="text-center">דברו איתנו!</h2>
  <?= \ymaker\social\share\widgets\SocialShare::widget([
    'configurator' => 'socialShareBgCircle',
    //'url'          => \yii\helpers\Url::to('absolute/route/to/page', true),
    //'url'          => 'https://elbit-campaign.hunterhrms.com/2',
    //'title'        => 'Title of the page',
    //'description'  => 'Description of the page...',
    //'imageUrl'     => \yii\helpers\Url::to('absolute/route/to/image.png', true),
    //'imageUrl'     => 'https://elbit-campaign.hunterhrms.com/images/logo-v2.png'
  ]); ?>

</section>
