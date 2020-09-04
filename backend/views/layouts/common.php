<?php
/**
 * @author Eugine Terentev <eugine@terentev.net>
 * @author Victor Gonzalez <victor@vgr.cl>
 * @var yii\web\View $this
 * @var string $content
 */

use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\MainSidebarMenu;
use common\models\TimelineEvent;
use yii\bootstrap4\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\log\Logger;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;
use rmrevin\yii\fontawesome\FAR;
use rmrevin\yii\fontawesome\FAS;
use common\components\keyStorage\FormModel;
use common\components\keyStorage\FormWidget;

$bundle = BackendAsset::register($this);
Yii::info(Yii::$app->components["i18n"]["translations"]['*']['class'], 'test');

$keyStorage = Yii::$app->keyStorage;

$logEntries = [
    [
        'label' => Yii::t('backend', 'У вас {num} записей в журнале', ['num' => SystemLog::find()->count()]),
        'linkOptions' => ['class' => ['dropdown-item', 'dropdown-header']]
    ],
    '<div class="dropdown-divider"></div>',
];
foreach (SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry) {
    $logEntries[] = [
        'label' => FAS::icon('exclamation-triangle', ['class' => [$logEntry->level === Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow']]). ' '. $logEntry->category,
        'url' => ['/system/log/view', 'id' => $logEntry->id]
    ];
    $logEntries[] = '<div class="dropdown-divider"></div>';
}

$logEntries[] = [
    'label' => 'Смотреть всё',
    'url' => ['/system/log/index'],
    'linkOptions' => ['class' => ['dropdown-item', 'dropdown-footer']]
];
?>

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
<div class="wrapper">
    <!-- navbar -->
    <?php NavBar::begin([
        'renderInnerContainer' => false,
        'options' => [
            'class' => [
                'main-header',
                'navbar',
                'navbar-expand',
                'navbar-dark',
                $keyStorage->get('adminlte.navbar-no-border') ? 'border-bottom-0' : null,
                $keyStorage->get('adminlte.navbar-small-text') ? 'text-sm' : null,
            ],
        ],
    ]); ?>

        <!-- left navbar links -->
        <?php echo Nav::widget([
            'options' => ['class' => ['navbar-nav']],
            'encodeLabels' => false,
            'items' => [
                [
                    // sidebar menu toggler
                    'label' => FAS::icon('bars'),
                    'url' => '#',
                    'options' => [
                        'data' => ['widget' => 'pushmenu'],
                        'role' => 'button',
                    ]
                ],
            ]
        ]); ?>
        <!-- /left navbar links -->

        <!-- right navbar links -->
        <?php echo Nav::widget([
            'options' => ['class' => ['navbar-nav', 'ml-auto']],
            'encodeLabels' => false,
            'items' => [
                [
                    // timeline events
                    'label' => FAR::icon('bell').' <span class="badge badge-success navbar-badge">'.TimelineEvent::find()->today()->count().'</span>',
                    'url'  => ['/timeline-event/index']
                ],
                [
                    // log events
                    'label' => FAS::icon('clipboard-list').' <span class="badge badge-warning navbar-badge">'.SystemLog::find()->count().'</span>',
                    'url' => '#',
                    'linkOptions' => ['class' => ['no-caret']],
                    'dropdownOptions' => [
                        'class' => ['dropdown-menu', 'dropdown-menu-lg', 'dropdown-menu-right'],
                    ],
                    'items' => $logEntries,
                ],
                '<li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        '.Html::img(Yii::$app->user->identity->userProfile->getAvatar('/img/anonymous.png'), ['class' => ['img-circle', 'elevation-2', 'bg-white', 'user-image'], 'alt' => 'User image']).'
                        '.Html::tag('span', Yii::$app->user->identity->publicIdentity, ['class' => ['d-none', 'd-md-inline']]).'
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            '.Html::img(Yii::$app->user->identity->userProfile->getAvatar('/img/anonymous.png'), ['class' => ['img-circle', 'elevation-2', 'bg-white'], 'alt' => 'User image']).'
                            <p>
                                '.Yii::$app->user->identity->publicIdentity.'
                                <small>'.Yii::t('backend', 'Участник с {0, date, short}', Yii::$app->user->identity->created_at).'</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="float-left">
                                '.Html::a('Профиль', ['/sign-in/profile'], ['class' => 'btn btn-default btn-flat']).'
                            </div>
                            <div class="float-left">
                                '.Html::a('Аккаунт', ['/sign-in/account'], ['class' => 'btn btn-default btn-flat']).'
                            </div>
                            <div class="float-right">
                                '.Html::a('Выход', ['/sign-in/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']).'
                            </div>
                        </li>
                    </ul>
                </li>
                ',
                [
                    // control sidebar button
                    'label' => FAS::icon('th-large'),
                    'url'  => '#',
                    'linkOptions' => [
                        'data' => ['widget' => 'control-sidebar', 'slide' => 'true'],
                        'role' => 'button'
                    ],
                    'visible' => Yii::$app->user->can('administrator'),
                ],
            ]
        ]); ?>
        <!-- /right navbar links -->

    <?php NavBar::end(); ?>
    <!-- /navbar -->

    <!-- main sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 <?php echo $keyStorage->get('adminlte.sidebar-no-expand') ? 'sidebar-no-expand' : null ?>">
        <!-- brand logo -->
        <a href="/" class="brand-link text-center <?php echo $keyStorage->get('adminlte.brand-text-small') ? 'text-sm' : null ?>">
            <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8"> -->
            <span class="brand-text font-weight-bold"><?php echo Yii::$app->name ?></span>
        </a>
        <!-- /brand logo -->

        <!-- sidebar -->
        <div class="sidebar">
            <!-- sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php echo Html::img(
                        Yii::$app->user->identity->userProfile->getAvatar('/img/anonymous.png'),
                        ['class' => ['img-circle', 'elevation-2', 'bg-white'], 'alt' => 'User image']
                    ) ?>
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo Yii::$app->user->identity->publicIdentity ?></a>
                </div>
            </div>
            <!-- /sidebar user panel -->

            <!-- sidebar menu -->
            <nav class="mt-2">
                <?php echo MainSidebarMenu::widget([
                    'options' => [
                        'class' => [
                            'nav',
                            'nav-pills',
                            'nav-sidebar',
                            'flex-column',
                            $keyStorage->get('adminlte.sidebar-small-text') ? 'text-sm' : null,
                            $keyStorage->get('adminlte.sidebar-flat') ? 'nav-flat' : null,
                            $keyStorage->get('adminlte.sidebar-legacy') ? 'nav-legacy' : null,
                            $keyStorage->get('adminlte.sidebar-compact') ? 'nav-compact' : null,
                            $keyStorage->get('adminlte.sidebar-child-indent') ? 'nav-child-indent' : null,
                        ],
                        'data' => [
                            'widget' => 'treeview',
                            'accordion' => 'false'
                        ],
                        'role' => 'menu',
                    ],
                    'items' => [
                        [
                            'label' => 'Главная',
                            'options' => ['class' => 'nav-header'],
                        ],
                        [
                            'label' => 'Хроника',
                            'icon' => FAS::icon('stream', ['class' => ['nav-icon']]),
                            'url' => ['/timeline-event/index'],
                            'badge' => TimelineEvent::find()->today()->count(),
                            'badgeBgClass' => 'badge-success',
                        ],
                        [
                            'label' => 'Пользователи',
                            'icon' => FAS::icon('users', ['class' => ['nav-icon']]),
                            'url' => ['/user/index'],
                            'active' => Yii::$app->controller->id === 'user',
                            'visible' => Yii::$app->user->can('administrator'),
                        ],
                        [
                            'label' => 'Контент',
                            'options' => ['class' => 'nav-header'],
                        ],
                        [
                            'label' => 'Объявления',
                            'url' => Url::to(['/content/advert/index']),
                            'icon' => FAS::icon('thumbtack', ['class' => ['nav-icon']]),
                            'active' => Yii::$app->controller->id === 'page',
                            'badge' => \common\models\Advert::draftAdvertsCount(),
                            'badgeBgClass' => 'badge-warning',
                        ],
                        [
                            'label' => 'Перевод',
                            'options' => ['class' => 'nav-header'],
                            'visible' => Yii::$app->components["i18n"]["translations"]['*']['class'] === \yii\i18n\DbMessageSource::class,
                        ],
                        [
                            'label' => 'Перевод',
                            'url' => ['/translation/default/index'],
                            'icon' => FAS::icon('language', ['class' => ['nav-icon']]),
                            'active' => (Yii::$app->controller->module->id == 'translation'),
                            'visible' => Yii::$app->components["i18n"]["translations"]['*']['class'] === \yii\i18n\DbMessageSource::class,
                        ],
                        [
                            'label' => 'Система',
                            'options' => ['class' => 'nav-header'],
                        ],
                        [
                            'label' => 'RBAC Rules',
                            'url' => '#',
                            'icon' => FAS::icon('user-shield', ['class' => ['nav-icon']]),
                            'options' => ['class' => 'nav-item has-treeview'],
                            'active' => (Yii::$app->controller->module->id == 'rbac'),
                            'items' => [
                                [
                                    'label' => 'Assignments',
                                    'url' => ['/rbac/rbac-auth-assignment/index'],
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                ],
                                [
                                    'label' => 'Items',
                                    'url' => ['/rbac/rbac-auth-item/index'],
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                ],
                                [
                                    'label' => 'Child Items',
                                    'url' => ['/rbac/rbac-auth-item-child/index'],
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                ],
                                [
                                    'label' => 'Rules',
                                    'url' => ['/rbac/rbac-auth-rule/index'],
                                    'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                ],
                            ],
                        ],
                        [
                            'label' => 'Files',
                            'url' => '#',
                            'icon' => FAS::icon('folder-open', ['class' => ['nav-icon']]),
                            'options' => ['class' => 'nav-item has-treeview'],
                            'active' => (Yii::$app->controller->module->id == 'file'),
                            'items' => [
                                [
                                    'label' => 'Storage',
                                    'url' => ['/file/storage/index'],
                                    'icon' => FAS::icon('database', ['class' => ['nav-icon']]),
                                    'active' => (Yii::$app->controller->id == 'storage'),
                                ],
                                [
                                    'label' => 'Manager',
                                    'url' => ['/file/manager/index'],
                                    'icon' => FAS::icon('archive', ['class' => ['nav-icon']]),
                                    'active' => (Yii::$app->controller->id == 'manager'),
                                ],
                            ],
                        ],
                        [
                            'label' => 'Ключ-Значение',
                            'url' => ['/system/key-storage/index'],
                            'icon' => FAS::icon('exchange-alt', ['class' => ['nav-icon']]),
                            'active' => (Yii::$app->controller->id == 'key-storage'),
                        ],
                        [
                            'label' => 'Кеш',
                            'url' => ['/system/cache/index'],
                            'icon' => FAS::icon('sync', ['class' => ['nav-icon']]),
                        ],
                        [
                            'label' => 'Информация о системе',
                            'url' => ['/system/information/index'],
                            'icon' => FAS::icon('tachometer-alt', ['class' => ['nav-icon']]),
                        ],
                        [
                            'label' => 'Журнал',
                            'url' => ['/system/log/index'],
                            'icon' => FAS::icon('clipboard-list', ['class' => ['nav-icon']]),
                            'badge' => SystemLog::find()->count(),
                            'badgeBgClass' => 'badge-danger',
                        ],
                    ],
                ]) ?>
            </nav>
            <!-- /sidebar menu -->
        </div>
        <!-- /sidebar -->
    </aside>
    <!-- /main sidebar -->

    <!-- content wrapper -->
    <div class="content-wrapper" style="min-height: 402px;">
        <!-- content header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?php echo Html::encode($this->title) ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?php echo Breadcrumbs::widget([
                            'tag' => 'ol',
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => ['breadcrumb', 'float-sm-right']]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /content header -->

        <!-- main content -->
        <section class="content">
            <div class="container-fluid">
                <?php if (Yii::$app->session->hasFlash('alert')) : ?>
                    <?php echo Alert::widget([
                        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                    ]) ?>
                <?php endif; ?>
                <?php echo $content ?>
            </div>
        </section>
        <!-- /main content -->

        <?php echo Html::a(FAS::icon('chevron-up'), '#', [
            'class' => ['btn', 'btn-primary', 'back-to-top'],
            'role' => 'button',
            'aria-label' => 'Scroll to top',
        ]) ?>
    </div>
    <!-- /content wrapper -->

    <!-- footer -->
    <footer class="main-footer <?php echo $keyStorage->get('adminlte.footer-small-text') ? 'text-sm' : null ?>">
        <strong>&copy; My Company <?php echo date('Y') ?></strong>
        <div class="float-right d-none d-sm-inline-block"><?php echo Yii::powered() ?></div>
    </footer>
    <!-- /footer -->

    <?php if (Yii::$app->user->can('administrator')) : ?>
    <!-- control sidebar -->
    <div class="control-sidebar control-sidebar-dark overflow-auto">
        <div class="control-sidebar-content p-3">
            <?php echo FormWidget::widget([
                'model' => new FormModel([
                    'keys' => [
                        'frontend.options' => [
                            'type' => FormModel::TYPE_HEADER,
                            'content' => 'Frontend Options'
                        ],
                        'frontend.maintenance' => [
                            'label' => 'Maintenance mode',
                            'type' => FormModel::TYPE_DROPDOWN,
                            'items' => [
                                'disabled' => 'Неактивно',
                                'enabled' => 'Активно',
                            ],
                        ],
                        'backend.options' => [
                            'type' => FormModel::TYPE_HEADER,
                            'content' => 'Backend Options'
                        ],
                        'adminlte.body-small-text' => [
                            'label' => 'Body small text',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.no-navbar-border' => [
                            'label' => 'No navbar border',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.navbar-small-text' => [
                            'label' => 'Navbar small text',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.navbar-fixed' => [
                            'label' => 'Fixed navbar',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.footer-small-text' => [
                            'label' => 'Footer small text',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.footer-fixed' => [
                            'label' => 'Fixed footer',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-small-text' => [
                            'label' => 'Sidebar small text',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-flat' => [
                            'label' => 'Sidebar flat style',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-legacy' => [
                            'label' => 'Sidebar legacy style',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-compact' => [
                            'label' => 'Sidebar compact style',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-fixed' => [
                            'label' => 'Fixed sidebar',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-collapsed' => [
                            'label' => 'Collapsed sidebar',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-mini' => [
                            'label' => 'Mini sidebar',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-child-indent' => [
                            'label' => 'Indent sidebar child menu items',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.sidebar-no-expand' => [
                            'label' => 'Disable sidebar hover/focus auto expand',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                        'adminlte.brand-small-text' => [
                            'label' => 'Brand small text',
                            'type' => FormModel::TYPE_CHECKBOX,
                        ],
                    ],
                ]),
                'submitText' => FAS::icon('save').' '.'Сохранить',
                'submitOptions' => ['class' => 'btn btn-primary'],
                'formOptions' => [
                    'action' => ['/system/settings/index'],
                    'method' => 'post'
                ],
            ]) ?>
        </div>
    </div>
    <!-- /control sidebar -->
    <?php endif; ?>
</div>
<?php $this->endContent(); ?>
