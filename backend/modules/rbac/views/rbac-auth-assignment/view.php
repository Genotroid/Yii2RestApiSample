<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthAssignment */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-assignment-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Редактировать', ['update', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Удалить', ['delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту запись?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body p-0">

            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'item_name',
                    'user_id',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
