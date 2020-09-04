<?php

use common\models\UserProfile;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap4\ActiveForm */

$this->title = 'Редактировать профиль'
?>

<?php $form = ActiveForm::begin() ?>
<div class="user-profile-form card">
    <div class="card-body">

        <?php echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
            'url'=>['avatar-upload']
        ]) ?>

        <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

        <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>

        <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>

        <?php echo $form->field($model, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>

        <?php echo $form->field($model, 'gender')->dropDownlist([
            UserProfile::GENDER_FEMALE => 'Женский',
            UserProfile::GENDER_MALE => 'Мужской'
        ]) ?>
    </div>
    <div class="card-footer">
        <?php echo Html::submitButton(FAS::icon('save').' '.'Save Changes', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>