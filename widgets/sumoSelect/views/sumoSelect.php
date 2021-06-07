<?php

use app\helpers\Helper;
?>

<div id="<?= $name ?>" class="submit-form flex space-around <?= $cssClass ?>">
    <form enctype="multipart/form-data">

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
