<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCss(<<<CSS
    .product-form {
        background: #1f2937;
        padding: 30px;
        border-radius: 12px;
        max-width: 700px;
        margin: auto;
        color: #f9fafb;
        font-family: 'Segoe UI', sans-serif;
    }

    .product-form .form-group {
        margin-bottom: 20px;
    }

    .product-form label {
        color: #f3f4f6;
        font-weight: bold;
    }

    .product-form input, .product-form textarea {
        background: #374151;
        color: #f9fafb;
        border: 1px solid #4b5563;
        padding: 10px;
        border-radius: 8px;
    }

    .product-form img {
        border: 2px solid #4ade80;
        border-radius: 8px;
        margin-top: 10px;
    }

    .grid-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .grid-preview img {
        width: 150px;
        height: auto;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .grid-preview img:hover {
        transform: scale(1.05);
    }
CSS);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'id')->textInput() ?>
    
    <?= $form->field($model, 'ProductName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ProductDescription')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'CreatedDate')->input('date') ?>

    <?= $form->field($model, 'ExpiryDate')->input('date') ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if ($model->Image): ?>
        <div class="grid-preview">
            <div>
                <strong>Current Image:</strong>
                <img src="<?= Yii::getAlias('@web/' . $model->Image) ?>" alt="Product Image">
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Save Product', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
