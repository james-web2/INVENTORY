<?php
use yii\helpers\Html;

/* @var $model app\models\Sale */
$this->title = 'Sale #' . $model->id;
?>
<div class="sale-view text-white">

    <h2><?= Html::encode($this->title) ?></h2>
    <p><?= Html::a('← Back to list', ['index'], ['class'=>'btn btn-secondary']) ?></p>

    <table class="table table-dark w-auto">
        <tr><th>ID</th><td><?= $model->id ?></td></tr>
        <tr><th>Date</th><td><?= $model->SaleDate ?></td></tr>
        <tr><th>Customer</th><td><?= $model->CustomerName ?> (ID <?= $model->customer_id ?>)</td></tr>
        <tr><th>Status</th><td><?= $model->Status ?></td></tr>
        <tr><th>Total</th><td><?= $model->total ?></td></tr>
        <tr><th>Total Amount</th><td>KES <?= number_format($model->TotalAmount,2) ?></td></tr>
        <tr><th>Created</th><td><?= $model->createdDate ?></td></tr>
    </table>
</div>
