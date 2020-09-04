<?php

/**
 * @var yii\web\View $this
 * @var common\models\Advert $model
 */

$this->title = 'Create Advert';
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
