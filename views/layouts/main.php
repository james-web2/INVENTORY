<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Breadcrumbs;
use yii\web\JqueryAsset;

AppAsset::register($this);

$this->registerCssFile('@web/css/custom.css');
$this->registerJsFile('@web/js/custom.js', ['depends' => [JqueryAsset::class]]);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- External Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode body {
            background-color: #1c1c1c;
            color: #e0e0e0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 240px;
            background-color: #343a40;
            color: white;
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
            z-index: 1000;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 12px;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .topbar {
            margin-left: 240px;
            background-color: #fff;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #dee2e6;
            transition: margin-left 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 500;
        }

        .topbar input[type="text"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-left: 10px;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        footer {
            margin-left: 240px;
            padding: 10px 0;
            background-color: #f1f1f1;
            text-align: center;
            transition: margin-left 0.3s ease;
        }

        .dark-mode .sidebar,
        .dark-mode .topbar,
        .dark-mode footer {
            background-color: #2d2d2d;
        }

        .dark-mode .sidebar a {
            color: #e0e0e0;
        }

        .dark-mode .topbar,
        .dark-mode .main-content,
        .dark-mode footer {
            color: #e0e0e0;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <?= Html::a('<i class="fas fa-home"></i><span> Home</span>', ['/site/index']) ?>
    <?= Html::a('<i class="fas fa-users"></i><span> Users</span>', ['/user/index']) ?>
    <?= Html::a('<i class="fas fa-box"></i><span> Products</span>', ['/product/index']) ?>
    <?= Html::a('<i class="fas fa-plus-circle"></i><span> Add Product</span>', ['/product/create']) ?>
    <?= Html::a('<i class="fas fa-tags"></i><span> Categories</span>', ['/category/index']) ?>
    <?= Html::a('<i class="fas fa-store"></i> Stores', ['/store/index'], ['class' => 'nav-link']) ?>
    <?= Html::a('<i class="fas fa-shopping-cart"></i><span> Sales</span>', ['/sale/index']) ?>
<?= Html::a('<i class="fas fa-shopping-cart"></i><span> Purchase Order</span>', ['/sale/index']) ?>
    <?= Html::a('<i class="fas fa-chart-bar"></i><span> Reports</span>', ['/report/index']) ?>
    <?= Html::a('<i class="fas fa-cog"></i><span> Settings</span>', ['/settings/index']) ?>
    
    <hr style="border-color: #6c757d;">
    <?= Html::a('<i class="fas fa-sign-out-alt text-danger"></i><span> Logout (' . (Yii::$app->user->identity->email ?? 'Guest') . ')</span>', ['/auth/logout'], ['data-method' => 'post']) ?>
</div>

<!-- Topbar -->
<div class="topbar" id="topbar">
    <?= Html::a('About', ['/site/about'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    <?= Html::a('Contact', ['/site/contact'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
    <input type="text" placeholder="Search...">
    <button id="toggleDark" class="btn btn-sm btn-dark ms-3">Dark Mode</button>
</div>

<!-- Main Content -->
<main class="main-content" id="mainContent">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <span class="text-muted">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></span>
    </div>
</footer>

<!-- Toggle Dark Mode -->
<script>
    $('#toggleDark').on('click', function () {
        $('html').toggleClass('dark-mode');
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
