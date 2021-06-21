<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\helpers\Helper;

?>

<div>
    <?php foreach ($jobs as $job) : ?>
        <div class="job-wrappwe flex space-between align-center" data-job-code="<?= Helper::getArrValue($job, 'JobCode') ?>">
            <div class="job-info flex flex-column space-between">
                <h2><? Helper::getArrValue($job, 'JobTitle') ?></h2>
                <p><?= date('d-m-Y', strtotime(Helper::getArrValue($job, 'UpdateDate'))) ?></p>
                <p>
                    <strong>
                        <?= Yii::t('app', 'Job Location:') ?>
                    </strong>
                    <?= Helper::getArrValue($job, 'RegionText') ?>
                </p>
            </div>
            <button class="bg-blue fg-white" data-job-code="<? Helper::getArrValue($job, 'JobCode') ?>">
                <?= Yii::t('app', 'Apply') ?>
            </button>
        </div>
    <?php endforeach; ?>
</div>