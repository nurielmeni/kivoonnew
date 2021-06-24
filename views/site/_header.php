<?php

use yii\helpers\Url;
use app\widgets\searchForm\SearchFormWidget;
use app\widgets\nav\NavWidget;

$navItems = require __DIR__ . '/_navItems.php';

?>

<header>
    <video id="video-background" class="home-element" poster="poster.jpg" autoplay muted loop>
        <source src="<?= Url::to('@web/videos/bgvideo.mp4') ?>" type="video/mp4">
    </video>

    <div class="header-content">
        <section class="flex space-between">
            <a href="\">
                <img src="<?= Url::to('@web/images/logo/logo_sofi.png') ?>" srcset="<?= Url::to('@web/images/logo/logo_sofi@2x.png') ?> 2x, <?= Url::to('@web/images/logo/logo_sofi@3x.png') ?> 3x" class="logo-sofi" alt="Logo Kivoon">
            </a>
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

        <h1 class="home-element text-center">
            בואו למצוא קריירה!
        </h1>

        <h1 class="search-results-element text-center">
            חיפוש משרות
        </h1>

        <div class="home-element">
            <?= SearchFormWidget::widget([
                'cssClass' => 'search-results-element',
                'serachFields' => [
                    [
                        'name' => 'select-category',
                        'type' => SearchFormWidget::SELECT,
                        'multiple' => true,
                        'options' => $categories,
                        'placeholder' => Yii::t('app', 'Category')
                    ],
                    [
                        'name' => 'select-location',
                        'type' => SearchFormWidget::SELECT,
                        'multiple' => true,
                        'options' => $locations,
                        'placeholder' => Yii::t('app', 'Location')
                    ],
                    [
                        'name' => Yii::t('app', 'Search'),
                        'type' => SearchFormWidget::SUBMIT,
                    ]
                ],
            ]) ?>

            <?= NavWidget::widget(['items' => $navItems, 'cssClass' => 'xs-up']) ?>

            <?= $this->render('_headerSocial') ?>
        </div>
    </div>

    <div id="search-results" class="bg-gray search-results-element" style="display: none;"></div>

</header>