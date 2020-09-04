<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItemChild */

$this->title = Yii::t('backend', 'Создание {modelClass}', [
    'modelClass' => 'Child Item',
]);
$this->params['breadcrumbs'][] = ['label' => 'Child Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-item-child-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
