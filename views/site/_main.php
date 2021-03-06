<?php

use yii\helpers\Url;
use app\widgets\iconTextArea\IconTextAreaWidget;
?>

<div class="home-element">
  <div class="arroe-divider bg-blue w-100 xs-up"></div>
</div>

<?= IconTextAreaWidget::widget([
  'name' => 'meet-us',
  'cssClass' => 'home-element',
  'image' => Url::to('@web/images/icons/info.svg', true),
  'title' => 'הכירו אותנו!',
  'content' => '<p>כיוון השמה הוקמה על מנת ליצור שינוי בעולם התעסוקה ולתת שירות שונה ואיכותי ללקוחות המגייסים מחד ולמועמדים מאידך.</p>' . '<p>היתרון המשמעותי ביותר שלנו, הוא הרכזות שלנו, שמגיעות אלינו עם ניסיון וש”כיוון” היא התחנה השניה או השלישית בקריירה שלהן. רובן ככולן אמהות שעובדות במשרה מותאמת. בשל כך, הגיוס אצלנו הוא מדויק תוך הבנת צרכי הלקוח, מבלי לגרום לו “לעבוד בשבילנו”.</p>'
]) ?>

<?= IconTextAreaWidget::widget([
  'name' => 'our-customers',
  'cssClass' => 'home-element',
  'image' => Url::to('@web/images/icons/customer.svg', true),
  'title' => 'הלקוחות שלנו',
  'content' => '<p>קשר אישי מול לקוח הוא אבן יסוד בעבודתנו, מועמד שאנו מייצגים נמצא בראש סדר העדיפויות אצל הלקוחות שלנו – בגלל שהם יודעים ומכירים שכש”כיוון” שולחים להם מועמד – כנראה שהוא בינגו!</p>'
]) ?>

<?= IconTextAreaWidget::widget([
  'name' => 'apply',
  'cssClass' => 'home-element apply-element',
  'image' => Url::to('@web/images/icons/curriculum-vitae.svg', true),
  'title' => 'שליחת קו״ח',
  'content' => $this->render('_applyForm', ['apply' => $apply])
]) ?>

<?= IconTextAreaWidget::widget([
  'name' => 'contact',
  'cssClass' => 'home-element contact-element',
  'image' => Url::to('@web/images/icons/headphones.svg', true),
  'title' => 'צרו קשר',
  'content' => $this->render('_contactForm', ['contact' => $contact])
]) ?>