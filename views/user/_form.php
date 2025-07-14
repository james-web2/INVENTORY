<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'created_at')->input('datetime-local') ?>
    <?= $form->field($model, 'updated_at')->input('datetime-local') ?>
    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'CreatedBy')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Image')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
