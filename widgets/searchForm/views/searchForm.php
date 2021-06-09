<?php

use app\helpers\Helper;
use app\widgets\SumoSelect\SumoSelectWidget;

?>

<div id="<?= $name ?>" class="submit-form flex space-around <?= $cssClass ?>">
	<form enctype="multipart/form-data">
		<?= SumoSelectWidget::widget(['name' => 'my-sumo']) ?>
		<?= SumoSelectWidget::widget(['multiple' => true, 'options' => ['1' => 'Named Options', '2' => 'Another one']]) ?>
		<?= SumoSelectWidget::widget(['config' => ['placeholder' => 'Test place holder']]) ?>
	</form>
</div>
<?php

$js = <<<JS
    if (typeof searchForm === 'undefined') return;

    SearchForm.init({
        name: '$name',
    });
JS;

$this->registerJs($js, yii\web\View::POS_READY);
