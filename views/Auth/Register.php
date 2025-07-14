<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background: url('/images/background1.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .overlay {
        background: rgba(0, 0, 0, 0.65);
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 0;
    }

    .register-wrapper {
        position: relative;
        z-index: 1;
        max-width: 450px;
        width: 100%;
        padding: 40px 30px;
        background: rgba(255, 255, 255, 0.97);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        text-align: center;
        animation: fadeInSlide 1.2s ease;
    }

    @keyframes fadeInSlide {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-wrapper h2 {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #333;
        animation: fadeIn 1.5s ease;
    }

    .form-control {
        height: 45px;
        margin-bottom: 15px;
        border-radius: 6px;
        padding: 10px;
        font-size: 15px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        animation: fadeIn 2s ease;
    }

    .btn-success {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        border: none;
        color: white;
        font-weight: bold;
        font-size: 16px;
        border-radius: 6px;
        transition: background 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .form-footer {
        margin-top: 20px;
        font-size: 14px;
        animation: fadeIn 2.2s ease;
    }

    .form-footer a {
        color: #007bff;
        text-decoration: underline;
    }

    .terms-text {
        font-size: 13px;
        text-align: left;
        margin-bottom: 15px;
        color: #444;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @media (max-width: 576px) {
        .register-wrapper {
            margin: 0 20px;
            padding: 30px 20px;
        }
    }
</style>

<div class="overlay"></div>

<div class="register-wrapper">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput([
        'class' => 'form-control',
        'placeholder' => 'Enter your email'
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput([
        'class' => 'form-control',
        'placeholder' => 'Enter your password'
    ]) ?>

    <?= $form->field($model, 'role')->dropDownList(
        ['admin' => 'Admin', 'manager' => 'Manager', 'customer' => 'Customer'],
        ['prompt' => 'Select Role', 'class' => 'form-control']
    ) ?>

    <?= $form->field($model, 'agreeTerms')->checkbox([
        'label' => 'I agree to the ' . Html::a('Terms and Privacy Policy', ['site/terms'], ['target' => '_blank']),
        'required' => true,
        'class' => 'terms-text'
    ]) ?>

    <?= Html::submitButton('Register', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

    <div class="form-footer">
        <p>Already have an account? <?= Html::a('Login here', ['auth/login']) ?></p>
    </div>
</div>
