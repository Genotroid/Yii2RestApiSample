<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 *
 * @var $this     \yii\web\View
 * @var $provider \probe\provider\ProviderInterface
 */

use common\models\FileStorageItem;
use common\models\User;
use rmrevin\yii\fontawesome\FAS;

$this->title = 'Информация о системе';

$this->registerJs("window.paceOptions = { ajax: false }", \yii\web\View::POS_HEAD);
$this->registerJsFile(
    Yii::$app->request->baseUrl . 'js/system-information/index.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::class,
            \common\assets\Flot::class,
            \yii\bootstrap4\BootstrapPluginAsset::class
        ]
    ]
);
?>

<div id="system-information-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo gmdate('H:i:s', $provider->getUptime()) ?>
                    </h3>
                    <p>
                        <?php echo 'Uptime' ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('clock') ?>
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?php echo $provider->getLoadAverage() ?>
                    </h3>
                    <p>
                        <?php echo 'Средняя нагрузка' ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('cogs') ?>
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?php echo User::find()->count() ?>
                    </h3>
                    <p>
                        <?php echo 'Регистраций' ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('user-plus') ?>
                </div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/user/index']) ?>" class="small-box-footer">
                    <?php echo 'Подробнее' ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        <?php echo FileStorageItem::find()->count() ?>
                    </h3>
                    <p>
                        <?php echo 'Файлов в хранилище' ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('copy') ?>
                </div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/file-storage/index']) ?>"
                   class="small-box-footer">
                    <?php echo 'Подробнее' ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

    <div class="card-deck mb-3">

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo 'Процессор' ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo 'Процессор' ?></dt>
                    <dd><?php echo $provider->getCpuModel() ?></dd>

                    <dt><?php echo 'Архитектура процессора' ?></dt>
                    <dd><?php echo $provider->getArchitecture() ?></dd>

                    <dt><?php echo 'Кол-во ядер' ?></dt>
                    <dd><?php echo $provider->getCpuCores() ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo 'Операционная система' ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo 'ОС' ?></dt>
                    <dd><?php echo $provider->getOsType() ?></dd>

                    <dt><?php echo 'Версия ОС' ?></dt>
                    <dd><?php echo $provider->getOsRelease() ?></dd>

                    <dt><?php echo 'Версия ядра' ?></dt>
                    <dd><?php echo $provider->getOsKernelVersion() ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>


        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo 'Время' ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo 'Системная дата' ?></dt>
                    <dd><?php echo Yii::$app->formatter->asDate(time()) ?></dd>

                    <dt><?php echo 'Системное время' ?></dt>
                    <dd><?php echo Yii::$app->formatter->asTime(time()) ?></dd>

                    <dt><?php echo 'Часовой пояс' ?></dt>
                    <dd><?php echo date_default_timezone_get() ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo 'Сеть' ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo 'Имя хоста' ?></dt>
                    <dd><?php echo $provider->getHostname() ?></dd>

                    <dt><?php echo 'Внутренний IP' ?></dt>
                    <dd><?php echo $provider->getServerIP() ?></dd>

                    <dt><?php echo 'Внешний IP' ?></dt>
                    <dd><?php echo $provider->getExternalIP() ?></dd>

                    <dt><?php echo 'Порт' ?></dt>
                    <dd><?php echo $provider->getServerVariable('SERVER_PORT') ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo 'ПО' ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo 'Веб-сервер' ?></dt>
                    <dd><?php echo $provider->getServerSoftware() ?></dd>

                    <dt><?php echo 'Версия РHP' ?></dt>
                    <dd><?php echo $provider->getPhpVersion() ?></dd>

                    <dt><?php echo 'Тип БД' ?></dt>
                    <dd><?php echo $provider->getDbType(Yii::$app->db->pdo) ?></dd>

                    <dt><?php echo 'Версия БД' ?></dt>
                    <dd><?php echo $provider->getDbVersion(Yii::$app->db->pdo) ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo 'Память' ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo 'Общая память' ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getTotalMem()) ?></dd>

                    <dt><?php echo 'Свободно памяти' ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getFreeMem()) ?></dd>

                    <dt><?php echo 'Общий Swap' ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getTotalSwap()) ?></dd>

                    <dt><?php echo 'Свободно Swap' ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getFreeSwap()) ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="cpu-usage" class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo 'Использование CPU' ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <?php echo 'В режиме реального времени' ?>
                        <div class="realtime btn-group" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                <?php echo 'Вкл' ?>
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                <?php echo 'Выкл' ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" style="height: 300px;">
                    </div>
                </div><!-- /.card-body-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="memory-usage" class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo 'Использование памяти' ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <?php echo 'В режиме реального времени' ?>
                        <div class="btn-group realtime" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                <?php echo 'Вкл' ?>
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                <?php echo 'Выкл' ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" style="height: 300px;">
                    </div>
                </div><!-- /.card-body-->
            </div>
        </div>
    </div>
</div>
