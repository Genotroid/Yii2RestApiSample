<?php

/**
 * @var $this  yii\web\View
 * @var $model common\models\WidgetText
 */

$this->title = Yii::t('backend', 'Редактирование {modelClass}: ', [
        'modelClass' => 'Text Block',
    ]) . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Текстовые блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>
