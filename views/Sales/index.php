<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Sales';

// Custom CSS styles
$this->registerCss(<<<CSS
.sales-index {
    font-family: 'Segoe UI', sans-serif;
    animation: fadeIn 0.6s ease-in-out;
    padding-bottom: 40px;
}

.sales-index h2 {
    color: #fff;
}

.overview-card {
    background: linear-gradient(145deg, #2a2e3a, #1c1f2b);
    color: #ffffff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    font-size: 1.05rem;
}

.overview-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.overview-card strong {
    font-size: 1.5rem;
    display: block;
    margin-top: 5px;
}

.sales-index .table {
    background-color: #2c2f3f;
    color: #ffffff;
}

.sales-index .table th {
    background-color: #444;
    color: #fff;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.sales-index .table td {
    vertical-align: middle;
}

.btn-success {
    background-color: #28a745;
    border: none;
    font-weight: bold;
}

.btn-success:hover {
    background-color: #218838;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}
CSS);
?>

<div class="sales-index container-fluid">

    <!-- Title + Create Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('➕ New Sale', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- Overview Cards -->
    <div class="row text-center g-3 mb-4">
        <div class="col-md-2 col-sm-6">
            <div class="overview-card">Total<br><strong><?= $totalSales ?></strong></div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="overview-card">Pending<br><strong><?= $pendingSales ?></strong></div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="overview-card">Draft<br><strong><?= $draftSales ?></strong></div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="overview-card">Paid<br><strong><?= $paidSales ?></strong></div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="overview-card">Value<br><strong>KES <?= number_format($salesValue, 2) ?></strong></div>
        </div>
    </div>

    <!-- Sales Table -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'SaleDate:date',
            [
                'label' => 'Customer',
                'attribute' => 'customer_id',
                'value' => fn($model) => $model->customer->name ?? 'Unknown',
            ],
            'Status',
            [
                'attribute' => 'TotalAmount',
                'label' => 'Total (KES)',
                'value' => fn($m) => number_format($m->TotalAmount, 2),
                'contentOptions' => ['class' => 'text-end'],
            ],
            'createdDate:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => fn($url, $model) => Html::a('👁️', $url, ['title' => 'View']),
                ],
            ],
        ],
    ]) ?>

</div>
