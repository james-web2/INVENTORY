<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $this yii\web\View */
/** @var $model app\models\Product */

$this->title = 'View Product #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Optional styling
$this->registerCss(<<<CSS
    .product-view {
        background: #f9fafb;
        padding: 30px;
        border-radius: 12px;
        max-width: 800px;
        margin: auto;
        font-family: 'Segoe UI', sans-serif;
    }
    .product-image {
        text-align: center;
        margin-bottom: 20px;
    }
    .product-image img {
        border: 2px solid #4ade80;
        border-radius: 10px;
        max-width: 300px;
        height: auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
CSS);
?>

<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
        ]) ?>
    </p>

    <div class="product-image">
        <?php if ($model->Image): ?>
            <?= Html::img(Yii::getAlias('@web/' . $model->Image), ['alt' => 'Product Image']) ?>
        <?php else: ?>
            <p><em>No image uploaded</em></p>
        <?php endif; ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ProductName',
            'ProductDescription:ntext',
            'CreatedDate',
            'ExpiryDate',
        ],
    ]) ?>

</div>
