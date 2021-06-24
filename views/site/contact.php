<div dir="rtl">
    <h3><?= Yii::t('app', 'Contact request') ?></h3>
    <br>
    <h4><?= Yii::t('app', 'Applicant details') ?></h4>
    <?php foreach ($model->attributes as $name => $value) : ?>
        <?php if ($name === 'content') continue; ?>
        <p><span style="font-weight: bold;"><?= $model->getAttributeLabel($name) ?>: </span> <?= $value ?></p>
    <?php endforeach; ?>
    <p><span style="font-weight: bold;"><?= $model->getAttributeLabel('content') ?>: </span> <?= $model->content ?></p>
</div>