<h2><?= Yii::t('app', 'CV Submitted Successfuly') ?></h2>
<p><?= Yii::t('app', 'The Cv were submited successfuly') ?></p>
<?php if ($jobCode && !empty($jobCode)) : ?>
    <p><small><?= Yii::t('app', 'to {jobCode}', ['jobCode' => $jobCode]) ?></small></p>
<?php endif; ?>