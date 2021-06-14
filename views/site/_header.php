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
            <img 
                src="<?= Url::to('@web/images/logo/logo_sofi.png') ?>"
                srcset="<?= Url::to('@web/images/logo/logo_sofi@2x.png') ?> 2x, <?= Url::to('@web/images/logo/logo_sofi@3x.png') ?> 3x"
                class="logo-sofi"
                alt="Logo Kivoon"
            >

            <ul class="social">
                <li>
                    <a href="#" title="דף לינקדאין של כיוון" tabindex="1">
                        <img src="<?= Url::to('@web/images/icons/in.svg') ?>" alt="LinkedIn">
                    </a>
                </li>
                <li>
                    <a href="#" title="דף פייסבוק של כיוון" tabindex="2">
                        <img src="<?= Url::to('@web/images/icons/f.svg') ?>" alt="Facebook">
                    </a>
                </li>
            </ul>
        </section>

        <h1 class="text-center">
            בואו למצוא קריירה!
        </h1>

        <?= SearchFormWidget::widget() ?>

        <?= $this->render('_headerSocial') ?>

    </div>
</header>