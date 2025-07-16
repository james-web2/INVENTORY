<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Purchase Orders';

$this->registerCss(<<<CSS
    .summary-card {
        background: #0a6bccff;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .summary-card:hover {
        transform: scale(1.03);
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .table-hover tbody tr:hover {
        background-color: #0369b3ff !important;
        transition: background-color 0.3s;
    }

    .table thead {
        background-color: #343a40;
        color: white;
    }

    .purchase-index {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
CSS);
?>

<div class="purchase-index">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= Html::a('➕ Create Purchase Order', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- Summary Cards Row 1 -->
    <div class="row text-center g-3 mb-2">
        <div class="col-md-3 summary-card">Total<br><strong><?= $totalOrders ?></strong></div>
        <div class="col-md-3 summary-card">Pending<br><strong><?= $pendingOrders ?></strong></div>
        <div class="col-md-3 summary-card">Received<br><strong><?= $receivedOrders ?></strong></div>
        <div class="col-md-3 summary-card">Draft<br><strong><?= $draftOrders ?></strong></div>
    </div>

    <!-- Summary Cards Row 2 -->
    <div class="row text-center g-3 mb-4">
        <div class="col-md-6 summary-card">Value<br><strong>KES <?= number_format($totalValue, 2) ?></strong></div>
        <div class="col-md-6 summary-card">Pending Value<br><strong>KES <?= number_format($pendingValue, 2) ?></strong></div>
    </div>

    <!-- Data Grid -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            [
                'attribute' => 'Reference',
                'format'    => 'raw',
                'value'     => fn($m) =>
                    Html::a($m->Reference, ['view', 'id' => $m->id], ['class' => 'text-decoration-none fw-bold text-primary'])
            ],
            'Supplier',
            'Branch',
            'date:date',
            'ExpectedDelivery:date',
            'Status',
            [
                'attribute' => 'Amount',
                'value'     => fn($m) => 'KES ' . number_format($m->Amount, 2),
                'contentOptions' => ['class' => 'text-end'],
            ],
        ],
    ]) ?>
</div>
