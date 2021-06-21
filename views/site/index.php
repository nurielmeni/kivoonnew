<?php

/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>

<?= $this->render('_header', ['categories' => $categories, 'locations' => $locations]) ?>

<main>
  <article class="home-element">
    <?= $this->render('_main', ['apply' => $apply, 'contact' => $contact]) ?>
  </article>
</main>

<?= $this->render('_footer') ?>