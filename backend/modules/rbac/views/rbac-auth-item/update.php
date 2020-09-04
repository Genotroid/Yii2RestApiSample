<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItem */

$this->title = Yii::t('backend', 'Редактирование {modelClass}: ', [
    'modelClass' => 'Item',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="rbac-auth-item-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
