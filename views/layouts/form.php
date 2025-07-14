<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = $model->isNewRecord ? 'Add Product' : 'Update Product';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'category')->textInput() ?>
    <?= $form->field($model, 'quantity')->input('number') ?>
    <?= $form->field($model, 'price')->input('number', ['step' => '0.01']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<div class="form-footer">
    <p>
        <?= Html::a('Back to Products', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>