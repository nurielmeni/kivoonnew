<footer class="bg-blue fg-white">
  <h2 class="text-center">חפשו אותנו גם ב:</h2>
  <?= \ymaker\social\share\widgets\SocialShare::widget([
    'configurator' => 'socialShare',
    //'url'          => \yii\helpers\Url::to('absolute/route/to/page', true),
    //'url'          => 'https://elbit-campaign.hunterhrms.com/2',
    //'title'        => 'Title of the page',
    //'description'  => 'Description of the page...',
    //'imageUrl'     => \yii\helpers\Url::to('absolute/route/to/image.png', true),
    //'imageUrl'     => 'https://elbit-campaign.hunterhrms.com/images/logo-v2.png'
  ]); ?>
  <p>
    <a class="fg-white" href="https://niloosoft.com/he/">POWERED BY NILOOSOFT HUNTER EDGE</a>
  </p>
</footer>