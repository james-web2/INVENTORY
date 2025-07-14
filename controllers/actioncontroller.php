<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/dashboard']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Role-based redirect (optional)
            $role = Yii::$app->user->identity->role;
            if ($role === 'admin') {
                return $this->redirect(['admin/dashboard']);
            } elseif ($role === 'manager') {
                return $this->redirect(['manager/dashboard']);
            } elseif ($role === 'customer') {
                return $this->redirect(['customer/dashboard']);
            }
            return $this->redirect(['site/dashboard']); // Default
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Redirect based on user role
     */
    protected function redirectDashboard($role)
    {
        switch ($role) {
            case 'admin':
                return $this->redirect(['admin/dashboard']);
            case 'manager':
                return $this->redirect(['manager/dashboard']);
            case 'customer':
                return $this->redirect(['customer/dashboard']);
            default:
                return $this->redirect(['site/index']);
        }
    }
}