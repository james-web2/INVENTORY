<?php

namespace app\controllers;

use Yii;
use app\models\StockOut;
use app\models\Product;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class StockOutController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StockOut::find()->with('product'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new StockOut();
        $products = Product::find()->select(['Name', 'id'])->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'products' => $products,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = StockOut::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested stock-out record does not exist.');
    }
}
