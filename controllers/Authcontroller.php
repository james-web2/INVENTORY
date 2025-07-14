<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\DynamicModel;
use app\models\User;
use yii\web\ForbiddenHttpException;

class AuthController extends Controller
{
    public $layout = false;

    /**
     * Login Action
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirectDashboard(Yii::$app->user->identity->role);
        }

        $model = new DynamicModel(['email', 'password', 'role']);
        $model->addRule(['email', 'password', 'role'], 'required');
        $model->addRule('email', 'email');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne([
                'email' => $model->email,
                'role' => $model->role,
            ]);

            if (!$user) {
                $model->addError('email', 'No user found with this email and role.');
            } elseif (!Yii::$app->security->validatePassword($model->password, $user->password_hash)) {
                $model->addError('password', 'Incorrect password.');
            } else {
                Yii::$app->user->login($user);
                return $this->redirectDashboard($user->role);
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Register Action
     */
    public function actionRegister()
    {
        $model = new DynamicModel(['email', 'password', 'role', 'agreeTerms']);
        $model->addRule(['email', 'password', 'role'], 'required');
        $model->addRule('email', 'email');
        $model->addRule('agreeTerms', 'required', ['message' => 'You must agree to the terms.']);
        $model->addRule('agreeTerms', 'boolean');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (User::find()->where(['email' => $model->email])->exists()) {
                Yii::$app->session->setFlash('error', 'This email is already registered.');
            } else {
                $user = new User();
                $user->email = $model->email;
                $user->role = $model->role;
                $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->status = 10;
                $user->created_at = time();
                $user->updated_at = time();

                if ($user->save(false)) { // disable validation here if no rules in User model
                    Yii::$app->session->setFlash('success', 'Account created successfully. Please log in.');
                    return $this->redirect(['auth/login']);
                } else {
                    Yii::$app->session->setFlash('error', 'Registration failed. Please try again.');
                }
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    /**
     * Logout Action
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['auth/login']);
    }

    /**
     * Redirect user to dashboard based on role
     */
    private function redirectDashboard($role)
    {
        switch (strtolower($role)) {
            case 'admin':
                return $this->redirect(['admin/dashboard']);
            case 'manager':
                return $this->redirect(['manager/dashboard']);
            case 'customer':
                return $this->redirect(['customer/dashboard']);
            default:
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Invalid role.');
                return $this->redirect(['auth/login']);
        }
    }
}
