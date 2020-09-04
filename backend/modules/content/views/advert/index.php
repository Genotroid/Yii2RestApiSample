<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var \backend\modules\content\models\search\AdvertSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index row">
    <div class="col-lg-7 col-md-10 col-sm-12">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_advert',
            'layout' => "<div class='col-md-12'>{items}</div>\n<div class='col-md-12 col-sm-12'>{pager}</div>",
            'options' => [
                'tag' => 'div',
                'class' => 'row'
            ],
        ]); ?>
    </div>
</div>

