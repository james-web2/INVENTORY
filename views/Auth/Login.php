<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background: url('/images/blackground3.jpeg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .overlay {
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 0;
    }

    .login-wrapper {
        position: relative;
        z-index: 1;
        max-width: 450px;
        width: 100%;
        padding: 40px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        text-align: center;
        animation: fadeInSlideUp 1.2s ease;
    }

    @keyframes fadeInSlideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-wrapper h1 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        animation: fadeIn 1.5s ease;
    }

    .login-wrapper h2 {
        font-size: 20px;
        margin: 20px 0;
        color: #555;
        animation: fadeIn 1.8s ease;
    }

    .form-control {
        height: 45px;
        margin-bottom: 15px;
        border-radius: 6px;
        padding: 10px;
        animation: fadeIn 2s ease;
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 6px;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-footer {
        text-align: center;
        margin-top: 20px;
    }

    .form-footer a {
        color: #007bff;
        text-decoration: underline;
    }

    .social-support {
        margin-top: 30px;
    }

    .social-support p {
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    .social-icons a {
        margin: 0 8px;
        font-size: 20px;
        color: #007bff;
        transition: color 0.3s;
        text-decoration: none;
    }

    .social-icons a:hover {
        color: #0056b3;
    }

    .alert {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        text-align: left;
        animation: fadeIn 2s ease;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
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
        .login-wrapper {
            margin: 0 20px;
            padding: 30px 20px;
        }
    }
</style>

<div class="overlay"></div>

<div class="login-wrapper">
    <h1>Welcome to Inventory Management System</h1>
    <h2><?= Html::encode($this->title) ?></h2>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

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

    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

    <div class="form-footer">
        <p>Don't have an account? <?= Html::a('Register here', ['auth/register']) ?></p>
    </div>

    <div class="social-support">
        <p>Need help or support?</p>
        <p>
            <?= Html::a('📧 Email', 'mailto:jovialjaymol@gmail.com') ?> |
            <?= Html::a('💬 WhatsApp', 'https://wa.me/254793808108?text=Hello%20need%20help', ['target' => '_blank']) ?>
        </p>
    </div>
</div>
