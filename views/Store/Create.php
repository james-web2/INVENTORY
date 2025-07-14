<?php

use yii\helpers\Html;

$this->title = 'Create Store';
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-4">
    <h2 class="mb-3 text-dark"><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
