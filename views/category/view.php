<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->ProductName;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('✏️ Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('🗑️ Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'value' => $model->Image
                    ? Html::img(Yii::getAlias('@web/' . $model->Image), ['width' => '100'])
                    : 'No image',
            ],
        ],
    ]) ?>
</div>
