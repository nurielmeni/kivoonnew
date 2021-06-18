<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<style>
    #mc p,
    #mc label {
        display: inline-block;
    }

    #mc label {
        width: 80px;
        text-align: left;
        margin-left: 1re;
        font-weight: bold;
    }
</style>

<div id="mc" class="mail-wrapper" dir="rtl">
    <h2>טופס יצירת קשר שהתקבל מאתר המשרות של כיוון</h2>


    <fieldset dir="rtl">
        <legend>פרטי הפונה:</legend>

        <div class="user-info">
            <label for="mc-name">שם פרטי:</label>
            <p id="mc-name"><?= $model['firstname'] ?></p>
        </div>

        <div class="user-info">
            <label for="mc-last">משפחה:</label>
            <p id="mc-last"><?= $model['lastname'] ?></p>
        </div>

        <div class="user-info">
            <label for="mc-mail">אימייל:</label>
            <p id="mc-mail"><?= $model['email'] ?></p>
        </div>
    </fieldset>

    <section>
        <?= $model['content'] ?>
    </section>

</div>