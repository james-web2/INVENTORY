<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model app\models\CustomerOrder */
/** @var $products app\models\Product[] */

$this->title = 'Place Order';
?>

<div class="container mt-4">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($products, 'id', 'ProductDescription'),
        ['prompt' => 'Select Product']
    ) ?>

    <?= $form->field($model, 'quantity')->input('number', ['min' => 1]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Place Order', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
