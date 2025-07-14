<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
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
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="row no-gutters">
    <div class="col-md-2 sidebar">
        <h4 class="text-white">InventoryPro</h4>
        <hr style="border-color: #6c757d;">
        <?php
        $role = Yii::$app->user->identity->role ?? '';
        echo Html::a('Dashboard', ["/$role/dashboard"]);
        if ($role === 'admin' || $role === 'manager') {
            echo Html::a('Products', ['/product/index']);
            echo Html::a('Stock In/Out', ['/stock/index']);
            echo Html::a('Categories', ['/category/index']);
        }
        echo Html::a('View Products', ['/product/view']);
        echo Html::a('Logout', ['/auth/logout']);
        ?>
    </div>

    <div class="col-md-10 main-content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
