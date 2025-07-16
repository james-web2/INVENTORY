<?php

namespace app\controllers;

use Yii;
use app\models\Purchase;
use app\models\PurchaseSearch; // ✅ ADD THIS LINE
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PurchaseController extends Controller
{
    public function actionIndex()
    {
        $searchModel  = new PurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // --- dashboard metrics ---
        $totalOrders   = Purchase::find()->count();
        $draftOrders   = Purchase::find()->where(['Status' => 'Draft'])->count();
        $pendingOrders = Purchase::find()->where(['Status' => 'Pending'])->count();
        $receivedOrders= Purchase::find()->where(['Status' => 'Received'])->count();
        $totalValue    = Purchase::find()->sum('Amount');
        $pendingValue  = Purchase::find()->where(['Status' => 'Pending'])->sum('Amount');

        return $this->render('index', compact(
            'searchModel','dataProvider',
            'totalOrders','draftOrders','pendingOrders','receivedOrders',
            'totalValue','pendingValue'
        ));
    }

    public function actionCreate()
    {
        $model = new Purchase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('model'));
    }
}
