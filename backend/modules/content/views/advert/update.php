<?php

/**
 * @var yii\web\View $this
 * @var common\models\Advert $model
 */

$this->title = 'Update Advert: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="advert-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
