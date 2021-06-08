<?php

use yii\helpers\Url;
use app\widgets\SearchForm\SearchFormWidget;

?>

<header class="overlay white">
    <video id="video-background" poster="poster.jpg" autoplay muted loop>
        <source src="<?= Url::to('@web/videos/bgvideo.mp4') ?>" type="video/mp4">
    </video>
    <div class="header-content">
        <section class="flex space-between">
            <img src="<?= Url::to('@web/images/image-placeholder.svg') ?>" alt="kivoon-logo" width="80" />
            <ul class="social">
                <li>
                    <a href="#" title="דף לינקדאין של כיוון" tabindex="1">in</a>
                </li>
                <li>
                    <a href="#" title="דף פייסבוק של כיוון" tabindex="2">f</a>
                </li>
            </ul>
        </section>

        <h1 class="text-center">
            בואו למצוא קריירה!
        </h1>

        <?= SearchFormWidget::widget() ?>
    </div>
</header>