<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

use common\components\keyStorage\FormWidget;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var $model \common\components\keyStorage\FormModel
 */

$this->title = 'Настройки приложения';

?>

<?php echo FormWidget::widget([
    'model' => $model,
    'formClass' => \yii\bootstrap4\ActiveForm::class,
    'submitText' => FAS::icon('save').' '.'Сохранить',
    'submitOptions' => ['class' => 'btn btn-primary'],
]) ?>
