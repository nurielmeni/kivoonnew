<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\widgets\iconTextArea\IconTextAreaWidget;

$this->title = Yii::$app->name;

?>

<?= $this->render('_header') ?>


<div class="arroe-divider bg-blue w-100 xs-up"></div>

<?= IconTextAreaWidget::widget([
  'name' => 'meet-us',
  'image' => Url::to('@web/images/icons/info.svg', true),
  'title' => 'הכירו אותנו!',
  'content' => '<p>כיוון השמה הוקמה על מנת ליצור שינוי בעולם התעסוקה ולתת שירות שונה ואיכותי ללקוחות המגייסים מחד ולמועמדים מאידך.</p>' . '<p>היתרון המשמעותי ביותר שלנו, הוא הרכזות שלנו, שמגיעות אלינו עם ניסיון וש”כיוון” היא התחנה השניה או השלישית בקריירה שלהן. רובן ככולן אמהות שעובדות במשרה מותאמת. בשל כך, הגיוס אצלנו הוא מדויק תוך הבנת צרכי הלקוח, מבלי לגרום לו “לעבוד בשבילנו”.</p>'
]) ?>

<?= IconTextAreaWidget::widget([
  'name' => 'our-customers',
  'image' => Url::to('@web/images/icons/customer.svg', true),
  'title' => 'הלקוחות שלנו',
  'content' => '<p>קשר אישי מול לקוח הוא אבן יסוד בעבודתנו, מועמד שאנו מייצגים נמצא בראש סדר העדיפויות אצל הלקוחות שלנו – בגלל שהם יודעים ומכירים שכש”כיוון” שולחים להם מועמד – כנראה שהוא בינגו!</p>'
]) ?>

<?= IconTextAreaWidget::widget([
  'name' => 'apply',
  'image' => Url::to('@web/images/icons/curriculum-vitae.svg', true),
  'title' => 'שליחת קו״ח',
  'content' => $this->render('_applyForm', ['apply' => $apply])
]) ?>

<?= IconTextAreaWidget::widget([
  'name' => 'contact',
  'image' => Url::to('@web/images/icons/headphones.svg', true),
  'title' => 'צרו קשר',
  'content' => $this->render('_contactForm', ['contact' => $contact])
]) ?>

<?= $this->render('_footer') ?>