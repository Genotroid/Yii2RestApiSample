<?php

namespace frontend\controllers;

use yii\base\Controller;

class AdvertController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}