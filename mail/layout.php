<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar h3 {
            text-align: center;
            padding: 20px 10px;
            font-size: 1.5em;
            margin: 0;
            background-color: #23272b;
        }
        .sidebar a {
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            display: block;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 220px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .topbar {
            background-color: #6c757d;
            color: #fff;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 999;
            font-size: 1.2em;
        }
        .content-area {
            padding: 20px;
            overflow-y: auto;
            flex-grow: 1;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="sidebar">
    <h3>Inventory</h3>
    <a href="<?= Yii::$app->homeUrl ?>">Dashboard</a>
    <a href="<?= Yii::$app->urlManager->createUrl('product/index') ?>">Products</a>
    <a href="<?= Yii::$app->urlManager->createUrl('category/index') ?>">Categories</a>
    <a href="<?= Yii::$app->urlManager->createUrl('supplier/index') ?>">Suppliers</a>
    <a href="<?= Yii::$app->urlManager->createUrl('transaction/index') ?>">Transactions</a>
</div>

<div class="main-content">
    <div class="topbar">
        Welcome, <?= Yii::$app->user->isGuest ? 'Guest' : Html::encode(Yii::$app->user->identity->username) ?>
    </div>

    <div class="content-area">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
  
   