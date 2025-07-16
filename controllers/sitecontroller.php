<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use app\models\Product;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/dashboard']);
        }

        $query = Product::find();
        $search = Yii::$app->request->get('q');

        if (!empty($search)) {
            $query->andWhere(['like', 'ProductDescription', $search]);
        }

        $products = $query->all();

        return $this->render('index', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    public function actionDashboard()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['auth/login']);
        }

        $role = Yii::$app->user->identity->role;

        return match ($role) {
            'admin' => $this->redirect(['admin/dashboard']),
            'manager' => $this->redirect(['manager/dashboard']),
            'customer' => $this->redirect(['customer/dashboard']),
            default => $this->goHome(),
        };
    }

    public function actionLogin()
    {
        return Yii::$app->user->isGuest
            ? $this->redirect(['auth/login'])
            : $this->redirect(['site/dashboard']);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['auth/login']);
    }

    public function actionAbout()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'customer') {
            throw new ForbiddenHttpException('Only customers can view this page.');
        }

        return $this->render('about');
    }

    public function actionContact()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'customer') {
            throw new ForbiddenHttpException('Only customers can contact us via this page.');
        }

        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us!');
            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        return $this->render('error', ['exception' => $exception]);
    }

    public function actionTestEmail()
    {
        Yii::$app->Email->send('jovialjaymol@gmail.com', 'Test Subject', 'This is the email body.');
        echo "Email sent!";
    }

    public function actionTerms()
    {
        return $this->render('terms');
    }

    public function actionDebug()
    {
        $data = Yii::$app->db->createCommand('SELECT TOP 1 * FROM Product')->queryOne();
        echo "<pre>"; print_r($data); echo "</pre>";
        Yii::$app->end();
    }
}
