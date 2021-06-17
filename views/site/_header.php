<?php

use yii\helpers\Url;
use app\widgets\searchForm\SearchFormWidget;
use app\widgets\nav\NavWidget;

$navItems = require __DIR__ . '/_navItems.php';

?>

<header>
    <video id="video-background" poster="poster.jpg" autoplay muted loop>
        <source src="<?= Url::to('@web/videos/bgvideo.mp4') ?>" type="video/mp4">
    </video>

    <div class="header-content">
        <section class="flex space-between">
            <img src="<?= Url::to('@web/images/logo/logo_sofi.png') ?>" srcset="<?= Url::to('@web/images/logo/logo_sofi@2x.png') ?> 2x, <?= Url::to('@web/images/logo/logo_sofi@3x.png') ?> 3x" class="logo-sofi" alt="Logo Kivoon">
            <?= \nurielmeni\socialConnect\socialConnectWidget::widget([
                'cssClass' => 'xs-up',
                'size' => '38px',
                'color' => '#5378ae',
                'items' => [
                    'facebook' => [
                        'url' => '#',
                    ],
                    'linkedin' => [
                        'url' => '#',
                    ]
                ]
            ]) ?>
        </section>

        <h1 class="text-center">
            בואו למצוא קריירה!
        </h1>

        <?= SearchFormWidget::widget() ?>

        <?= NavWidget::widget(['items' => $navItems, 'cssClass' => 'xs-up']) ?>

        <?= $this->render('_headerSocial') ?>

    </div>
</header>