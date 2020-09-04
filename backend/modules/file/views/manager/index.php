<?php

/**
 * @var $this yii\web\View
 */

$this->title = 'Менеджер файлов';

$this->params['breadcrumbs'][] = $this->title;

?>

<?php echo alexantr\elfinder\ElFinder::widget([
    'connectorRoute' => ['connector'],
    'settings' => [
        'height' => '500px',
        'width' => '100%'
    ],
    'buttonNoConflict' => true,
]) ?>