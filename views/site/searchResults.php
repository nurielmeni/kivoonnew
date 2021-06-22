<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\helpers\Helper;

?>
<div class="container leggend">
    <p><?= Yii::t('app', 'The search completed. {0,number} jobs were found.', count($jobs)) ?></p>
</div>
<div class="container">
    <?php foreach ($jobs as $job) : ?>
        <div class="job-wrapper flex space-between flex-wrap align-center bg-white" data-job-code="<?= Helper::getArrValue($job, 'JobCode') ?>">
            <h2 class="w-100 margin-none"><?= Helper::getArrValue($job, 'JobTitle') ?></h2>
            <div class="job-info flex flex-column space-between">
                <p><?= date('d-m-Y', strtotime(Helper::getArrValue($job, 'UpdateDate'))) ?></p>
                <p>
                    <strong>
                        <?= Yii::t('app', 'Job Location:') ?>
                    </strong>
                    <?= Helper::getArrValue($job, 'RegionText') ?>
                </p>
                <p><button type="text" class="show-job-details fg-green bg-transparent border-none underline"><?= Yii::t('app', 'Show job details') ?></button></p>
                <div class="job-details" style="display: none;">
                    <p class="underline"><strong><?= Yii::t('app', 'Description:') ?></strong></p>
                    <article><?= $job['Description'] ?></article>
                </div>
            </div>
            <button class="apply bg-blue fg-white" data-job-code="<? Helper::getArrValue($job, 'JobCode') ?>">
                <?= Yii::t('app', 'Apply') ?>
            </button>
        </div>
    <?php endforeach; ?>
</div>