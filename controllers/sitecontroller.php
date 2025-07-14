<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Product;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * Homepage — redirect to dashboard if logged in, otherwise show product catalog.
     */
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

    /**
     * Role-based dashboard redirection.
     */
    public function actionDashboard()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['auth/login']);
        }

        $role = Yii::$app->user->identity->role;

        switch ($role) {
            case 'admin':
                return $this->redirect(['admin/dashboard']);
            case 'manager':
                return $this->redirect(['manager/dashboard']);
            case 'customer':
                return $this->redirect(['customer/dashboard']);
            default:
                return $this->goHome();
        }
    }

    /**
     * Login redirect.
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/dashboard']);
        }

        return $this->redirect(['auth/login']);
    }

    /**
     * Logout and return to login page.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['auth/login']);
    }

    /**
     * About Page
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Contact Page
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us!');
            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    /**
     * Error page
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        return $this->render('error', ['exception' => $exception]);
    }

    /**
     * Test email
     */
    public function actionTestEmail()
    {
        Yii::$app->Email->send('jovialjaymol@gmail.com', 'Test Subject', 'This is the email body.');
        echo "Email sent!";
    }

    /**
     * Terms and Conditions
     */
    public function actionTerms()
    {
        return $this->render('terms');
    }

    /**
     * Database debug (for development use only)
     */
    public function actionDebug()
    {
        $data = Yii::$app->db->createCommand('SELECT TOP 1 * FROM Product')->queryOne();
        echo "<pre>"; print_r($data); echo "</pre>";
        Yii::$app->end();
    }
}
