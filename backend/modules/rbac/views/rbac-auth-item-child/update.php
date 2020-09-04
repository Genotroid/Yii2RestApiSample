<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItemChild */

$this->title = Yii::t('backend', 'Редактирование {modelClass}: ', [
    'modelClass' => 'Child Item',
]) . $model->parent;
$this->params['breadcrumbs'][] = ['label' => 'Child Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="rbac-auth-item-child-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
