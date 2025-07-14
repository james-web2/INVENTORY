<?php
use yii\grid\GridView;
use yii\helpers\Html; // ✅ This line is needed

$this->title = 'Product Report';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $products,
    ]),
    'columns' => [
        'id',
        'ProductDescription',
        'CreatedDate',
        'ExpiryDate',
        [
            'attribute' => 'Image',
            'format' => 'html',
            'value' => fn($model) => Html::img('/uploads/' . $model->Image, ['width' => '50']),
        ],
    ],
]) ?>
