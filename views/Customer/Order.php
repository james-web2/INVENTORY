<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $model app\models\CustomerOrder */
/** @var $product app\models\Product */

$this->title = 'Place Order';
?>
<div class="container mt-4">
    <h2><?= Html::encode($this->title) ?></h2>

    <p><strong>Product:</strong> <?= Html::encode($product->ProductDescription) ?></p>
    <p><strong>Price:</strong> KES <?= Html::encode(number_format($product->Price, 2)) ?></p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1]) ?>

    <div class="form-group mt-2">
        <?= Html::submitButton('Confirm Order', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['site/index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
