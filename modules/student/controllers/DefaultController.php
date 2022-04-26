<?php

namespace app\modules\student\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserForm;
/**
 * Default controller for the `student` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionUser()
    {
        $model = new UserForm();
        if($model->load(Yii::$app->request->post() && $model->validate()))
        {
            return $this->render('user');
        }else
            return $this->render('user',['model' => $model]);
    }
}
