<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'kivoon-contact',
]); ?>

<div class="flex center row">
    <div class="flex flex-column space-between col">
        <?= $form->field($contact, 'firstname')
            ->textInput(['placeholder' => $contact->getAttributeLabel('firstname')])
            ->label(false) ?>

        <?= $form->field($contact, 'lastname')
            ->textInput(['placeholder' => $contact->getAttributeLabel('lastname')])
            ->label(false) ?>

        <?= $form->field($contact, 'email')
            ->textInput(['placeholder' => $contact->getAttributeLabel('email')])
            ->label(false) ?>
    </div>

    <div class="flex flex-column space-between col">
        <?= $form->field($contact, 'content')
            ->textArea(['placeholder' => $contact->getAttributeLabel('content')])
            ->label(false) ?>
    </div>
</div>

<div class="flex center form-group">
    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'bg-blue fg-white']) ?>
</div>

<?php ActiveForm::end(); ?>