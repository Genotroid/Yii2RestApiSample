<?php

namespace backend\modules\system\controllers;

use common\components\keyStorage\FormModel;
use Yii;
use yii\web\Controller;

class SettingsController extends Controller
{

    public function actionIndex()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => 'Maintenance mode',
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => 'Неактивно',
                        'enabled' => 'Активно',
                    ],
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
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => 'Настройки были успешно сохранены',
                'options' => ['class' => 'alert alert-success'],
            ]);
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
}
