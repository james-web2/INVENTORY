<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Sales';
?>
<div class="sales-index text-white">

    <div class="d-flex justify-content-between mb-3">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= Html::a('➕ New Sale', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- overview -->
    <div class="row mb-4 text-center g-3">
        <div class="col bg-dark rounded p-2">Total<br><b><?= $totalSales ?></b></div>
        <div class="col bg-dark rounded p-2">Pending<br><b><?= $pendingSales ?></b></div>
        <div class="col bg-dark rounded p-2">Draft<br><b><?= $draftSales ?></b></div>
        <div class="col bg-dark rounded p-2">Paid<br><b><?= $paidSales ?></b></div>
        <div class="col bg-dark rounded p-2">Value<br><b>KES <?= number_format($salesValue,2) ?></b></div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => ['class' => 'table table-dark table-hover'],
        'columns' => [
            'id',
            'SaleDate:date',
            'CustomerName',
            'Status',
            [
                'attribute' => 'TotalAmount',
                'value' => fn($m) => 'KES ' . number_format($m->TotalAmount, 2),
            ],
            'createdDate:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]) ?>
</div>
