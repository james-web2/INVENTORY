<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Stock Out Records';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-out-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Add Stock Out', ['create'], ['class' => 'btn btn-danger']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'label' => 'Product',
                'value' => function ($model) {
                    return $model->product->ProductDescription ?? '(Deleted)';
                },
            ],
            'quantity',
            'date',
        ],
    ]); ?>
</div>
