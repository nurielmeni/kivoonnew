<?php

use app\helpers\Helper;
use nurielmeni\sumoSelect\SumoSelectWidget;
?>

<div id="<?= $name ?>" class="search-form <?= $cssClass ?>">
	<form class="flex space-around align-center">
		<?php foreach ($serachFields as $serachField) : ?>
			<?php if ($serachField['type'] === $this->context::SELECT) : ?>
				<?= SumoSelectWidget::widget([
					'multiple' => $serachField['multiple'],
					'name' => $serachField['name'],
					'options' => $serachField['options'],
					'config' => [
						'placeholder' => $serachField['placeholder'],
					]
				]) ?>
			<?php elseif ($serachField['type'] === $this->context::TEXT) : ?>

			<?php elseif ($serachField['type'] === $this->context::SUBMIT) : ?>
				<div class="btn submit">
					<button type="submit" class="flex center bg-green fg-white border-none"><?= $serachField['name'] ?></button>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</form>
</div>
<?php

$js = <<<JS
    if (typeof SearchForm === 'undefined') return;

    SearchForm.init({
        name: '$name',
    });
JS;

$this->registerJs($js, yii\web\View::POS_READY);
