<?php
namespace app\controllers;

use Yii;
use app\models\Sales;
use app\models\SalesSearch; // ✅ Add this line
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesController implements CRUD actions for Sales model.
 */
class SalesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /** 📄 List all sales + summary metric */
   public function actionIndex()
{
    $searchModel = new SalesSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    // ✅ Calculate overview metrics
    $totalSales   = Sales::find()->count();
    $pendingSales = Sales::find()->where(['Status' => 'Pending'])->count();
    $draftSales   = Sales::find()->where(['Status' => 'Draft'])->count();
    $paidSales    = Sales::find()->where(['Status' => 'Paid'])->count();
    $salesValue   = Sales::find()->sum('TotalAmount');

    return $this->render('index', [
        'searchModel'   => $searchModel,
        'dataProvider'  => $dataProvider,
        'totalSales'    => $totalSales,
        'pendingSales'  => $pendingSales,
        'draftSales'    => $draftSales,
        'paidSales'     => $paidSales,
        'salesValue'    => $salesValue,
    ]);
}

    /** 🔍 View single sale */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** ➕ Create */
    public function actionCreate()
    {
        $model = new Sales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /** ✏️ Update */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /** 🗑️ Delete */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /** 🔐 Finder */
    protected function findModel($id)
    {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested sale does not exist.');
    }
}
