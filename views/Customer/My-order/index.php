<?php
use yii\helpers\Html;

/** @var $orders app\models\Purchase[] */

$this->title = 'My Orders';
?>
<div class="container mt-4">
    <h2 class="mb-3"><?= Html::encode($this->title) ?></h2>

    <?php if (!empty($orders)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Reference</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $index => $order): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($order->date ?? $order->CreatedDate) ?></td>
                        <td><?= Html::encode($order->Status) ?></td>
                        <td>KES <?= number_format($order->Amount, 2) ?></td>
                        <td><?= Html::encode($order->Reference) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">You have not placed any orders yet.</div>
    <?php endif ?>
</div>
