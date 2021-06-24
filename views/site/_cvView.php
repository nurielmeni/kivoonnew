<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

?>

<div dir="rtl">
    <h3><?= Yii::t('app', 'Application from jobs site') ?></h3>
    <br>
    <h4><?= Yii::t('app', 'Applicant details') ?></h4>
    <?php foreach ($model->attributes as $name => $value) : ?>
        <?php if ($name === 'cvfile' || $name === 'supplierId' || $name === 'jobId') continue; ?>
        <p><span style="font-weight: bold;"><?= $model->getAttributeLabel($name) ?>: </span> <?= $value ?></p>
    <?php endforeach; ?>
</div>