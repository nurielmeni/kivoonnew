<?php

use app\helpers\Helper;
use nurielmeni\sumoSelect\SumoSelectWidget;


?>

<div id="<?= $name ?>" class="search-form <?= $cssClass ?>">
	<form enctype="multipart/form-data" class="flex space-around align-center">
		<?= SumoSelectWidget::widget([
			'multiple' => true, 
			'name' => 'my-sumo',
			'config' => [
				'placeholder' => 'תחום',
			]
		]) ?>

		<?= SumoSelectWidget::widget([
			'multiple' => true, 
			'options' => [
				'1' => 'Named Options', 
				'2' => 'Another one'
			],
			'config' => [
				'placeholder' => 'מיקום',
			]
		]) ?>
		<div class="btn submit">
			<button type="submit" class="flex center bg-green fg-white border-none">חפש</button>
		</div>
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
