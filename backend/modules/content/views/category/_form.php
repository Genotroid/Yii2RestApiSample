<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var common\models\ArticleCategory $model
 * @var common\models\ArticleCategory[] $categories
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                <?php echo 'Create a new category' ?>
            </h3>
        </div>
        <div class="card-body">
            <?php echo $form->errorSummary($model) ?>
            <?php echo $form->field($model, 'parent_id')->dropDownList($categories, ['prompt' => '']) ?>

            <?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

            <?php echo $form->field($model, 'slug')
                ->hint('Если вы оставите это поле пустым, ЧПУ будет сгенерирован автоматически')
                ->textInput(['maxlength' => 1024]) ?>

            <?php echo $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.'Создать':FAS::icon('save').' '. 'Save Changes',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
