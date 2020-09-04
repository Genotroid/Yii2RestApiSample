<?php

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var common\models\ArticleCategory[] $categories
 */
$this->title = Yii::t('backend', 'Редактирование {modelClass}: ', [
        'modelClass' => 'Article',
    ]) . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';

?>

<?php echo $this->render('_form', [
    'model' => $model,
    'categories' => $categories,
]) ?>
