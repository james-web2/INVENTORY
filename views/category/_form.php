<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'ProductID')->textInput() ?>
    <?= $form->field($model, 'ProductName')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ProductDescription')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'CreatedDate')->input('date') ?>
    <?= $form->field($model, 'ExpiryDate')->input('date') ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->Image): ?>
        <div class="mb-3">
            <strong>Current Image:</strong><br>
            <img src="<?= Yii::getAlias('@web') . '/' . $model->Image ?>" width="150">
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
