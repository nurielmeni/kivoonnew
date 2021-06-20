<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'kivoon-apply',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<div class="flex center row">
    <div class="flex flex-column space-between col">
        <?= $form->field($apply, 'firstname')
            ->textInput(['placeholder' => $apply->getAttributeLabel('firstname')])
            ->label(false) ?>

        <?= $form->field($apply, 'email')
            ->textInput(['placeholder' => $apply->getAttributeLabel('email')])
            ->label(false) ?>
    </div>

    <div class="flex flex-column space-between col">
        <?= $form->field($apply, 'lastname')
            ->textInput(['placeholder' => $apply->getAttributeLabel('lastname')])
            ->label(false) ?>

        <?= $form->field($apply, 'phone')
            ->textInput(['placeholder' => $apply->getAttributeLabel('phone')])
            ->label(false) ?>
    </div>
</div>

<div class="flex flex-column space-between">
    <?= $form->field($apply, 'cvfile')->fileInput(['style' => 'display: none;']) ?>
    <div class="selected-file-name cvfile fg-blue" style="display: none;"></div>
</div>
<div class="flex center form-group">
    <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'bg-blue fg-white']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php
$js = <<< JS
    $('#applyform-cvfile').on('change', function() {
        var filename = $(this).val().split('\\\\').pop();
        if (filename.length > 0) {
            $('.selected-file-name.cvfile').text(filename).show();
        } else {
            $('.selected-file-name.cvfile').text('').hide();
        }
    });

JS;

$this->registerJs($js, $this::POS_READY);
