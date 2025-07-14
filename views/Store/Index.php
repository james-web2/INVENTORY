<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Stores';
$this->registerCssFile('@web/css/store.css');
?>

<div class="store-index container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('➕ Add Store', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- Search bar appears automatically via filterModel in GridView -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'StoreName',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Search Store Name...'
                ]
            ],
            [
                'attribute' => 'Location',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Search Location...'
                ]
            ],
            'ManagerName',
            'Phone',
            [
                'attribute' => 'CreatedDate',
                'format' => ['datetime', 'medium'],
                'filter' => false
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>
</div>
