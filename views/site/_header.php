<?php

use yii\helpers\Url;
use app\widgets\searchForm\SearchFormWidget;
use app\widgets\nav\NavWidget;

$navItems = require __DIR__ . '/_navItems.php';

?>

<video id="video-background" class="home-element" poster="poster.jpg" autoplay muted loop>
    <source src="<?= Url::to('@web/videos/bgvideo.mp4') ?>" type="video/mp4">
</video>

<header>


    <div class="header-content">
        <section class="flex space-between">
            <a href="\">
                <img src="<?= Url::to('@web/images/logo/logo_sofi.png') ?>" srcset="<?= Url::to('@web/images/logo/logo_sofi@2x.png') ?> 2x, <?= Url::to('@web/images/logo/logo_sofi@3x.png') ?> 3x" class="logo-sofi" alt="Logo Kivoon">
            </a>
            <?= \nurielmeni\socialConnect\SocialConnectWidget::widget([
                'size' => '36px',
                'color' => '#104ca2',
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

        </section>

        <h1 class="home-element text-center">
            <?= Yii::t('app', 'Find career!') ?>
        </h1>

        <h1 class="search-results-element text-center" style="display: none;">
            <?= Yii::t('app', 'Job Search') ?>
        </h1>

        <div class="home-element main-content">
            <?= SearchFormWidget::widget([
                'cssClass' => 'home-element search-results-element',
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