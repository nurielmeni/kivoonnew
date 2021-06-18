<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'kivoon-contact',
]); ?>

<div class="flex space-between">
    <div class="flex flex-column space-between">
        <?= $form->field($contact, 'firstname', [
            'template' => '{input}{label}{error}',
        ])
            ->textInput(['placeholder' => $contact->getAttributeLabel('firstname')])
            ->label(false) ?>

        <?= $form->field($contact, 'lastname')
            ->textInput(['placeholder' => $contact->getAttributeLabel('lastname')])
            ->label(false) ?>

        <?= $form->field($contact, 'email')
            ->textInput(['placeholder' => $contact->getAttributeLabel('email')])
            ->label(false) ?>
    </div>

    <div class="col">
        <?= $form->field($contact, 'content')
            ->textInput(['placeholder' => $contact->getAttributeLabel('email')])
            ->label(false) ?>
    </div>
</div>

<div class="flex center">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>