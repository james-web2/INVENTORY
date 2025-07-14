<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $searchModel  app\models\PurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Orders';
?>
<div class="purchase-index text-white">

    <!-- header row -->
    <div class="d-flex justify-content-between mb-3">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= Html::a('➕ Create Purchase Order', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- overview cards -->
    <div class="row mb-4 text-center g-3">
        <div class="col bg-dark rounded p-2">Total<br><b><?= $totalOrders ?></b></div>
        <div class="col bg-dark rounded p-2">Pending<br><b><?= $pendingOrders ?></b></div>
        <div class="col bg-dark rounded p-2">Received<br><b><?= $receivedOrders ?></b></div>
        <div class="col bg-dark rounded p-2">Draft<br><b><?= $draftOrders ?></b></div>
        <div class="col bg-dark rounded p-2">Value<br><b>KES <?= number_format($totalValue,2) ?></b></div>
        <div class="col bg-dark rounded p-2">Pending Value<br><b>KES <?= number_format($pendingValue,2) ?></b></div>
    </div>

    <!-- data grid -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'tableOptions' => ['class' => 'table table-dark table-hover'],
        'columns' => [
            [
                'attribute' => 'Reference',
                'format'    => 'raw',
                'value'     => fn($m)=>
                    Html::a($m->Reference, ['view','id'=>$m->id], ['class'=>'text-success'])
            ],
            'Supplier',
            'Branch',
            'date:date',
            'ExpectedDelivery:date',
            'Status',
            [
                'attribute' => 'Amount',
                'value'     => fn($m)=>'KES '.number_format($m->Amount,2),
            ],
        ],
    ]) ?>
</div>
