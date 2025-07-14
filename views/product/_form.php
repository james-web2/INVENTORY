<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // Required for file upload
    ]); ?>

    <?= $form->field($model, 'ProductDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreatedDate')->input('date') ?>

    <?= $form->field($model, 'ExpiryDate')->input('date') ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if ($model->Image): ?>
        <p><strong>Current Image:</strong><br>
            <img src="<?= Yii::getAlias('@web/' . $model->Image) ?>" width="200">
        </p>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
