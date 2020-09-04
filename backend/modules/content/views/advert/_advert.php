<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

switch ($model->status) {
    case \common\models\Advert::STATUS_PUBLISHED:
        $boxType = 'card-success';
        break;
    case \common\models\Advert::STATUS_BLOCKED:
        $boxType = 'card-danger';
        break;
    default:
        $boxType = 'card-warning';
        break;
} ?>
<div class="card <?= $boxType ?>  news-item">
    <div class="card-header with-border">
        Объявление: <?= Html::encode($model->title) ?>
        <div class="card-tools float-right">
            <button type="button" class="btn btn-card-tool" data-toggle="collapse" data-target="#collapse<?=$model->id?>" aria-expanded="true" aria-controls="collapse<?=$model->id?>"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div id="collapse<?=$model->id?>" class="card-body collapse">
        <p>
            <?= HtmlPurifier::process($model->description) ?>
        </p>
        <p>
            Цена : <?= HtmlPurifier::process($model->price) ?>
        </p>
    </div>
    <div class="card-footer">
        <div class="btn-group float-right" role="gruop">
            <?php if ($model->status === \common\models\Advert::STATUS_DRAFT || $model->status === \common\models\Advert::STATUS_BLOCKED) {
                echo Html::a('Опубликовать', ['advert/publish?id=' . $model->id], ['class' => 'btn btn-success']);
            } ?>
            <?php if ($model->status === \common\models\Advert::STATUS_DRAFT || $model->status === \common\models\Advert::STATUS_PUBLISHED) {
                echo Html::a('Заблокировать', ['advert/block?id=' . $model->id], ['class' => 'btn btn-danger']);
            } ?>
        </div>
    </div>
</div>
