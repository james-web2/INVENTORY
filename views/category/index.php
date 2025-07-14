<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('➕ Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'ProductID',
            'ProductName',
            'ProductDescription',
            [
                'attribute' => 'CreatedDate',
                'format' => ['date', 'php:Y-m-d'],
            ],
            [
                'attribute' => 'ExpiryDate',
                'format' => ['date', 'php:Y-m-d'],
            ],
            [
                'attribute' => 'Image',
                'format' => 'html',
                'value' => fn($model) => $model->Image 
                    ? Html::img(Yii::getAlias('@web/' . $model->Image), ['width' => '70']) 
                    : 'No image',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>
</div>
