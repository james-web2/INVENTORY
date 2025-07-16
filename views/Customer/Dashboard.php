<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Product;

$this->title = 'Customer Dashboard';
$products = Product::find()->all();
$nearExpiry = Product::find()
    ->where(['>', 'ExpiryDate', date('Y-m-d')])
    ->andWhere(['<', 'ExpiryDate', date('Y-m-d', strtotime('+30 days'))])
    ->all();
?>

<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}
.card-img-top {
    border-radius: 6px 6px 0 0;
}
.card-title {
    font-size: 18px;
    font-weight: 600;
}
</style>

<div class="container py-4">
    <div class="bg-primary text-white p-4 rounded shadow">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><?= Html::encode($this->title) ?></h1>
                <p class="lead">Welcome, <?= Html::encode(Yii::$app->user->identity->email) ?>!</p>
                <p>Explore available products and stay updated on expiring ones.</p>
            </div>
    
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">📦 Total Products</h5>
                    <p class="card-text display-4"><?= count($products) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">⏳ Products Nearing Expiry (30 days)</h5>
                    <p class="card-text display-4"><?= count($nearExpiry) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <input type="text" id="searchBox" class="form-control mb-4" placeholder="🔍 Search Products by Description">

    <!-- Product List -->
    <div class="mt-5">
        <h3 class="mb-3">🛒 Available Products</h3>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <?php
                $expiry = strtotime($product->ExpiryDate);
                $today = time();
                $daysLeft = floor(($expiry - $today) / 86400);
                $expiryClass = $daysLeft <= 10 ? 'text-danger' : ($daysLeft <= 30 ? 'text-warning' : 'text-success');
                ?>
                <div class="col-md-4 mb-4 product-card">
                    <div class="card h-100 shadow-sm">
                        <?php if ($product->Image): ?>
                            <img src="<?= Yii::getAlias('@web') . '/' . $product->Image ?>" class="card-img-top" alt="Product Image" style="height: 180px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($product->ProductDescription) ?></h5>
                            <p class="card-text">
                                <strong>Created:</strong> <?= Html::encode($product->CreatedDate) ?><br>
                                <strong class="<?= $expiryClass ?>">Expires: <?= Html::encode($product->ExpiryDate) ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="mt-5">
        <h4>🔗 Quick Access</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?= Url::to(['report/products']) ?>">📊 View Product Reports</a></li>
        </ul>
    </div>
</div>

<!-- Toast Welcome Notification -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="welcomeToast" class="toast bg-primary text-white" role="alert" data-bs-delay="4000">
        <div class="toast-body">
            🎉 Welcome back <?= Html::encode(Yii::$app->user->identity->email) ?>!
        </div>
    </div>
</div>

<script>
document.getElementById('searchBox').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('.product-card').forEach(card => {
        let desc = card.querySelector('.card-title').textContent.toLowerCase();
        card.style.display = desc.includes(keyword) ? 'block' : 'none';
    });
});

window.onload = () => {
    new bootstrap.Toast(document.getElementById('welcomeToast')).show();
};
</script>
