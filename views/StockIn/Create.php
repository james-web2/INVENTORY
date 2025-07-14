<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Stock In';
$this->params['breadcrumbs'][] = ['label' => 'Stock In', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-in-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="stock-in-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'product_id')->dropDownList($products, ['prompt' => 'Select a product']) ?>
        <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1]) ?>
        <?= $form->field($model, 'date')->input('date') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
