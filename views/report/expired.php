<?php
use yii\grid\GridView;

$this->title = 'Expired Products';
?>

<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $expired,
    ]),
    'columns' => [
        'id',
        'ProductDescription',
        'ExpiryDate',
    ],
]) ?>
