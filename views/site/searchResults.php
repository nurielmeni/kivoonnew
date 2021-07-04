<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\helpers\Helper;

?>
<div class="container leggend">
    <?php if (count($jobs) === 1) : ?>
        <p><?= Yii::t('app', 'The search completed. one jobs was found.') ?></p>
    <?php else : ?>
        <p><?= Yii::t('app', 'The search completed. {0,number} jobs were found.', count($jobs)) ?></p>
    <?php endif; ?>
</div>
<div class="container">
    <?php foreach ($jobs as $job) : ?>
        <section class="job-wrapper flex space-between flex-column bg-white" data-job-code="<?= Helper::getArrValue($job, 'JobCode') ?>">
            <h2 class="w-100 margin-none"><?= Helper::getArrValue($job, 'JobTitle') ?></h2>
            <div class="job-info flex space-between">
                <div class="right">
                    <p><?= date('d-m-Y', strtotime(Helper::getArrValue($job, 'UpdateDate'))) ?></p>
                    <p>
                        <strong>
                            <?= Yii::t('app', 'Job Location:') ?>
                        </strong>
                        <?= Helper::getArrValue($job, 'RegionText') ?>
                    </p>
                </div>
                <button class="apply bg-blue fg-white xs-up" data-job-code="<?= Helper::getArrValue($job, 'JobCode') ?>" data-job-id="<?= Helper::getArrValue($job, 'JobId') ?>">
                    <?= Yii::t('app', 'Apply') ?>
                </button>
            </div>
            <p><button type="text" class="show-job-details fg-green bg-transparent border-none underline"><?= Yii::t('app', 'Show job details') ?></button></p>
            <div class="job-details" style="display: none;">
                <?php if (!empty($job['Description'])) : ?>
                    <p class="underline"><strong><?= Yii::t('app', 'Description:') ?></strong></p>
                    <section>
                        <?= $job['Description'] ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($job['Requiremets'])) : ?>
                    <p class="underline"><strong><?= Yii::t('app', 'Requiremets:') ?></strong></p>
                    <section>
                        <?= $job['Requiremets'] ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($job['EmploymentType'])) : ?>
                    <p class="underline"><strong><?= Yii::t('app', 'EmploymentType:') ?></strong></p>
                    <section>
                        <?= $job['EmploymentType'] ?>
                    </section>
                <?php endif; ?>
            </div>
            <button class="apply bg-blue fg-white xs-down text-center" data-job-code="<?= Helper::getArrValue($job, 'JobCode') ?>">
                <?= Yii::t('app', 'Apply') ?>
            </button>
        </section>

    <?php endforeach; ?>
</div>