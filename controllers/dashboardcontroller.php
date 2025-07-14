<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use yii\helpers\Html;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        // Get count of products grouped by category
        $categoryCounts = Product::find()
            ->select(['category', 'COUNT(*) AS total'])
            ->groupBy('category')
            ->asArray()
            ->all();

        $categories = [];
        $counts = [];

        foreach ($categoryCounts as $row) {
            $categories[] = $row['category'];
            $counts[] = (int) $row['total'];
        }

        return $this->render('index', [
            'categories' => $categories,
            'counts' => $counts,
        ]);
    }
}
