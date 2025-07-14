<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;
use app\models\Product;
use app\models\StockTransaction;

$this->title = 'Admin Dashboard';

// Data
$totalUsers = User::find()->count();
$totalAdmins = User::find()->where(['role' => 'admin'])->count();
$totalManagers = User::find()->where(['role' => 'manager'])->count();
$totalCustomers = User::find()->where(['role' => 'customer'])->count();

$totalProducts = Product::find()->count();
$totalStockIn = StockTransaction::find()->where(['transaction_type' => 'IN'])->sum('quantity') ?: 0;
$totalStockOut = StockTransaction::find()->where(['transaction_type' => 'OUT'])->sum('quantity') ?: 0;

$recentUsers = User::find()->orderBy(['created_at' => SORT_DESC])->limit(5)->all();
$recentTx = StockTransaction::find()->orderBy(['created_at' => SORT_DESC])->limit(5)->all();
?>

<style>
    .dashboard-card {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .fade-in {
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container py-4 fade-in">
    <div class="bg-dark text-white p-4 rounded shadow mb-4">
        <h1 class="display-5 fw-bold"><?= Html::encode($this->title) ?></h1>
        <p class="lead">Welcome, <strong><?= Html::encode(Yii::$app->user->identity->email) ?></strong>!</p>
        <p>📊 System-wide overview for all roles.</p>
    </div>

    <!-- User Role Overview -->
    <div class="row text-white">
        <div class="col-md-3">
            <div class="card bg-info mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Total Users</h5>
                    <p class="display-6 fw-bold">👥 <?= $totalUsers ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Admins</h5>
                    <p class="display-6 fw-bold">🛡️ <?= $totalAdmins ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Managers</h5>
                    <p class="display-6 fw-bold">👔 <?= $totalManagers ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Customers</h5>
                    <p class="display-6 fw-bold">🛒 <?= $totalCustomers ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Summary -->
    <div class="row mt-4 text-white">
        <div class="col-md-4">
            <div class="card bg-secondary mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Total Products</h5>
                    <p class="display-6 fw-bold">📦 <?= $totalProducts ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Stock In</h5>
                    <p class="display-6 fw-bold">📥 <?= $totalStockIn ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success bg-opacity-25 mb-3 shadow dashboard-card">
                <div class="card-body text-center">
                    <h5>Stock Out</h5>
                    <p class="display-6 fw-bold">📤 <?= $totalStockOut ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h4 class="mb-3">👥 Recent Users</h4>
            <table class="table table-striped table-bordered shadow">
                <thead class="table-dark">
                    <tr>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentUsers as $user): ?>
                        <tr>
                            <td><?= Html::encode($user->email) ?></td>
                            <td><span class="badge bg-<?= $user->role === 'admin' ? 'success' : ($user->role === 'manager' ? 'warning' : 'secondary') ?>">
                                <?= ucfirst($user->role) ?>
                            </span></td>
                            <td><?= date('Y-m-d', $user->created_at) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Recent Stock Transactions -->
        <div class="col-md-6">
            <h4 class="mb-3">🔄 Recent Stock Transactions</h4>
            <table class="table table-striped table-bordered shadow">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentTx as $tx): ?>
                        <tr>
                            <td><?= Html::encode($tx->product->ProductDescription ?? 'N/A') ?></td>
                            <td>
                                <span class="badge bg-<?= $tx->transaction_type === 'IN' ? 'success' : 'danger' ?>">
                                    <?= Html::encode($tx->transaction_type) ?>
                                </span>
                            </td>
                            <td><?= Html::encode($tx->quantity) ?></td>
                            <td><?= date('Y-m-d', strtotime($tx->created_at)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Navigation -->
    <div class="mt-5">
        <h4>🚀 Admin Quick Access</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?= Url::to(['user/index']) ?>">👥 Manage Users</a></li>
            <li class="list-group-item"><a href="<?= Url::to(['product/index']) ?>">📦 Manage Products</a></li>
            <li class="list-group-item"><a href="<?= Url::to(['report/index']) ?>">📈 View Reports</a></li>
        </ul>
    </div>
</div>
