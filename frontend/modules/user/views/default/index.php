<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\bootstrap4\ActiveForm */

$this->title = 'Настройки пользователя'
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <h2><?php echo 'Настройки профиля' ?></h2>

    <?php echo $form->field($model->getModel('profile'), 'picture')->widget(
        Upload::class,
        [
            'url' => ['avatar-upload']
        ]
    )?>

    <div class="row">
        <div class="col">
            <?php echo $form->field($model->getModel('profile'), 'firstname')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col">
            <?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col">
            <?php echo $form->field($model->getModel('profile'), 'lastname')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php echo $form->field($model->getModel('profile'), 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
        </div>
        <div class="col">
            <?php echo $form->field($model->getModel('profile'), 'gender')->dropDownlist([
                \common\models\UserProfile::GENDER_FEMALE => 'Женский',
                \common\models\UserProfile::GENDER_MALE => 'Мужской'
            ], ['prompt' => '']) ?>
        </div>
    </div>

    <h2><?php echo 'Настройки аккаунта' ?></h2>

    <div class="row">
        <div class="col">
            <?php echo $form->field($model->getModel('account'), 'username') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model->getModel('account'), 'email')->input('email') ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php echo $form->field($model->getModel('account'), 'password')->passwordInput() ?>
        </div>
        <div class="col">
            <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton('Редактировать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
