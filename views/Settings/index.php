<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Settings';
?>

<div class="container py-4">
    <div class="card shadow p-4">
        <h2 class="mb-4">⚙️ Account Settings</h2>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['value' => '', 'placeholder' => 'Enter new password']) ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <?php if ($model->image): ?>
            <div class="mb-3">
                <label>Current Profile Image:</label><br>
                <img src="<?= Yii::getAlias('@web') . '/' . $model->image ?>" width="120" class="rounded">
            </div>
        <?php endif; ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<style>
    .container {
        max-width: 800px;
        margin: auto;
    }

    .card {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #343a40;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }