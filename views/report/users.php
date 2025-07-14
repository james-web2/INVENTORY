<?php
use yii\grid\GridView;

$this->title = 'User Report';
?>

<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $users,
    ]),
    'columns' => [
        'id',
        'email',
        'role',
        'status',
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:Y-m-d H:i'],
        ],
    ],
]) ?>
