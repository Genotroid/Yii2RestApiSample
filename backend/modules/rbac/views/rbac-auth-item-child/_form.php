<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\rbac\models\RbacAuthItem;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card">
        <div class="card-body">

            <?php echo $form->field($model, 'parent')->dropDownList(ArrayHelper::map(RbacAuthItem::find()->all(), 'name', 'name'), ['prompt' => 'Please select a parent item...']) ?>

            <?php echo $form->field($model, 'child')->dropDownList(ArrayHelper::map(RbacAuthItem::find()->all(), 'name', 'name'), ['prompt' => 'Please select a child item...']) ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.'Создать':FAS::icon('save').' '. 'Save Changes',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
