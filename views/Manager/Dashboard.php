<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Manager Dashboard';
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js');

$userEmail = Yii::$app->user->identity->email;
$userName = explode('@', $userEmail)[0]; // Extract name before '@'
?>

<div class="container py-4">
    <!-- Header -->
    <div class="bg-success text-white p-4 rounded shadow animate__animated animate__fadeInDown">
        <h1><?= Html::encode($this->title) ?></h1>
        <h4 class="mt-2">👋 Welcome back, <strong><?= ucfirst(Html::encode($userName)) ?></strong>!</h4>
        <p class="lead">You're logged in as <strong>Manager</strong>.</p>
    </div>

    <!-- Filter -->
    <div class="card mt-4 mb-4 p-3 shadow-sm animate__animated animate__fadeIn">
        <?php $form = ActiveForm::begin(['method' => 'get']); ?>
        <div class="row">
            <div class="col-md-5">
                <?= Html::label('Start Date', 'start') ?>
                <?= Html::input('date', 'start', Yii::$app->request->get('start'), ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-5">
                <?= Html::label('End Date', 'end') ?>
                <?= Html::input('date', 'end', Yii::$app->request->get('end'), ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <?= Html::submitButton('Filter', ['class' => 'btn btn-primary w-100']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <!-- Metrics -->
    <div class="row text-white">
        <div class="col-md-4">
            <div class="card bg-info shadow mb-3 animate__animated animate__zoomIn">
                <div class="card-body text-center">
                    <h5>📦 Total Products</h5>
                    <p class="display-6"><?= $totalProducts ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success shadow mb-3 animate__animated animate__zoomIn">
                <div class="card-body text-center">
                    <h5>⬆️ Stock In</h5>
                    <p class="display-6"><?= $totalStockIn ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger shadow mb-3 animate__animated animate__zoomIn">
                <div class="card-body text-center">
                    <h5>⬇️ Stock Out</h5>
                    <p class="display-6"><?= $totalStockOut ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart -->
    <div class="card mt-4 shadow p-4 animate__animated animate__fadeInUp">
        <h4>📊 Stock In vs Stock Out (Animated)</h4>
        <canvas id="stockChart" height="100"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('stockChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Stock In', 'Stock Out'],
                    datasets: [{
                        label: 'Quantity',
                        data: [<?= $totalStockIn ?>, <?= $totalStockOut ?>],
                        backgroundColor: ['#28a745', '#dc3545'],
                        borderRadius: 12,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 1500,
                        easing: 'easeOutBounce'
                    },
                    plugins: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Stock Summary (In vs Out)',
                            font: {
                                size: 18
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- Low Stock -->
    <h4 class="mt-5">🛑 Low Stock Alerts (<?= count($lowStockProducts) ?>)</h4>
    <?php if (count($lowStockProducts)): ?>
        <table class="table table-bordered animate__animated animate__fadeIn">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lowStockProducts as $product): ?>
                <tr>
                    <td><?= Html::encode($product->ProductDescription) ?></td>
                    <td><?= Html::encode($product->Quantity) ?></td>
                    <td><?= Html::encode($product->ExpiryDate) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-success">✅ All products are sufficiently stocked.</p>
    <?php endif; ?>

    <!-- Recent Transactions -->
    <h4 class="mt-5">🔄 Recent Stock Transactions</h4>
    <?php if ($recent): ?>
        <table class="table table-striped animate__animated animate__fadeInUp">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($recent as $tx): ?>
                <tr>
                    <td><?= Html::encode($tx->product->ProductDescription ?? 'N/A') ?></td>
                    <td>
                        <span class="badge bg-<?= $tx->transaction_type === 'IN' ? 'success' : 'danger' ?>">
                            <?= Html::encode($tx->transaction_type) ?>
                        </span>
                    </td>
                    <td><?= Html::encode($tx->quantity) ?></td>
                    <td><?= Html::encode(date('Y-m-d', strtotime($tx->created_at))) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No recent transactions.</p>
    <?php endif; ?>

    <!-- Quick Access -->
    <h4 class="mt-5">🔗 Quick Access</h4>
    <ul class="list-group list-group-flush mb-5">
        <li class="list-group-item"><a href="<?= Url::to(['product/index']) ?>">📋 Manage Products</a></li>
        <li class="list-group-item"><a href="<?= Url::to(['stock/index']) ?>">📦 Manage Stock</a></li>
        <li class="list-group-item"><a href="<?= Url::to(['report/index']) ?>">📊 View Reports</a></li>
    </ul>
</div>
