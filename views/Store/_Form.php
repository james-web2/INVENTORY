<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Store $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'store-form'],
]); ?>

<?= $form->field($model, 'StoreName')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'Location')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'ManagerName')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create Store' : 'Update Store', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
