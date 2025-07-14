<?php

use yii\helpers\Html;

$this->title = 'Store: ' . $model->StoreName;
?>

<div class="container mt-4">
    <h2 class="text-dark mb-3"><?= Html::encode($this->title) ?></h2>

    <table class="table table-striped table-bordered w-50">
        <tr><th>Store Name</th><td><?= Html::encode($model->StoreName) ?></td></tr>
        <tr><th>Location</th><td><?= Html::encode($model->Location) ?></td></tr>
        <tr><th>Manager Name</th><td><?= Html::encode($model->ManagerName) ?></td></tr>
        <tr><th>Phone</th><td><?= Html::encode($model->Phone) ?></td></tr>
        <tr><th>Created Date</th><td><?= Yii::$app->formatter->asDatetime($model->CreatedDate, 'medium') ?></td></tr>
    </table>

    <div class="mt-3">
        <?= Html::a('← Back to Store List', ['index'], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Are you sure?', 'method' => 'post']
        ]) ?>
    </div>
</div>
