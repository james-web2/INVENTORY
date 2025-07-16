<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

// ✅ CSS for modern layout and image styling
$this->registerCss(<<<CSS
.product-index {
    padding: 50px;
    background: #f4f6f8;
    font-family: 'Segoe UI', sans-serif;
}

.table {
    background-color: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(0,0,0,0.05);
}

.table th {
    background: #1f2937;
    color: white;
    font-size: 16px;
    text-align: center;
}

.table td {
    vertical-align: middle;
    text-align: center;
    font-size: 15px;
}

.img-wrapper {
    width: 200px;
    height: 200px;
    margin: auto;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
    border-radius: 12px;
}

.img-wrapper:hover img {
    transform: scale(1.08);
}

.stock-low {
    color: #e11d48;
    font-weight: bold;
}

.stock-ok {
    color: #059669;
    font-weight: bold;
}
CSS);
?>

<div class="product-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-hover w-100'],
            'layout' => "{items}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'ProductDescription',

                [
                    'attribute' => 'CreatedDate',
                    'format' => ['date', 'medium'],
                ],
                [
                    'attribute' => 'ExpiryDate',
                    'format' => ['date', 'medium'],
                ],

                [
                    'label' => 'Available Stock',
                    'value' => 'currentStock',
                    'contentOptions' => function ($model) {
                        return ['class' => $model->currentStock <= 5 ? 'stock-low' : 'stock-ok'];
                    },
                ],

                [
                    'attribute' => 'Image',
                    'label' => 'Product Image',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $imagePath = Yii::getAlias('@webroot/' . $model->Image);
                        $imageUrl  = Yii::getAlias('@web/' . $model->Image);

                        if (!empty($model->Image) && file_exists($imagePath)) {
                            return '<div class="img-wrapper">' .
                                Html::img($imageUrl, ['alt' => 'Product Image']) .
                                '</div>';
                        }

                        return '<span class="text-muted">No image</span>';
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]) ?>
    </div>
</div>
