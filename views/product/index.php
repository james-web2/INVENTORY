<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index container mt-4">
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h2 class="text-dark"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('➕ Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ProductDescription',
            [
                'attribute' => 'CreatedDate',
                'format' => ['date', 'medium'],
            ],
            [
                'attribute' => 'ExpiryDate',
                'format' => ['date', 'medium'],
            ],

            // ✅ Realtime Available Stock
            [
                'label' => 'Available Stock',
                'value' => 'currentStock',
                'contentOptions' => function ($model) {
                    $stock = $model->currentStock;
                    return ['style' => $stock <= 5 ? 'color:red; font-weight:bold;' : 'color:green;'];
                }
            ],

            // ✅ Product Image Preview
            [
                'attribute' => 'Image',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->Image
                        ? Html::img(Yii::getAlias('@web') . '/' . $model->Image, ['width' => '100', 'class' => 'img-thumbnail'])
                        : 'No image';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>
</div>
