<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Purchase;
use app\models\Product;
use app\models\CustomerOrder;

class CustomerController extends Controller
{
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionMyOrder()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'customer') {
            return $this->goHome();
        }

        $orders = CustomerOrder::find()
            ->where(['customer_id' => Yii::$app->user->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('my-order/index', [
            'orders' => $orders,
        ]);
    }

    public function actionCreateOrder($product_id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'customer') {
            return $this->goHome();
        }

        $product = Product::findOne($product_id);
        if (!$product) {
            throw new NotFoundHttpException('Product not found.');
        }

        $model = new CustomerOrder();
        $model->product_id = $product_id;
        $model->customer_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->total_price = $product->Price * $model->quantity;
            $model->status = 'pending';
            $model->created_at = date('Y-m-d H:i:s');
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Order placed successfully!');
            return $this->redirect(['my-order']);
        }

        return $this->render('order', [
            'model' => $model,
            'product' => $product,
        ]);
    }
}
