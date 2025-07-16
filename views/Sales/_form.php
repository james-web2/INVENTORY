<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerCss(<<<CSS
.sale-form-wrapper {
    background: #1e1e2f;
    color: #fff;
    padding: 40px 20px;
    border-radius: 12px;
    margin: 20px auto;
    width: 100%;
    max-width: 100%;
    animation: fadeIn 0.5s ease-in-out;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
}

.sale-form .form-control {
    background-color: #2e43b8ff;
    border: 1px solid #444;
    border-radius: 8px;
    color: #fff;
}

.sale-form .form-label {
    font-weight: 600;
    margin-bottom: 5px;
}

.sale-form .btn-primary {
    width: 100%;
    padding: 12px;
    font-weight: bold;
    background-color: #28a745;
    border: none;
}

.sale-form .btn-primary:hover {
    background-color: #218838;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
CSS);

$form = ActiveForm::begin();
?>

<div class="container-fluid sale-form-wrapper">
    <h3 class="text-center mb-4">🧾 Create / Update Sale</h3>

    <div class="sale-form">

        <div class="row mb-3">
            <div class="col-md-6">
                <?= $form->field($model, 'SaleDate')->input('date') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'customer_id')->input('number', ['placeholder' => 'Enter Customer ID']) ?>
            </div>
        </div>

        <div class="mb-3">
            <?= $form->field($model, 'CustomerName')->textInput(['placeholder' => 'Enter customer full name']) ?>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <?= $form->field($model, 'total')->input('number', ['step' => '0.01', 'placeholder' => 'Enter total']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'TotalAmount')->input('number', ['step' => '0.01', 'placeholder' => 'Enter final amount']) ?>
            </div>
        </div>

        <div class="mb-4">
            <?= $form->field($model, 'Status')->dropDownList([
                'Draft'     => 'Draft',
                'Pending'   => 'Pending',
                'Paid'      => 'Paid',
                'Cancelled' => 'Cancelled',
            ], ['prompt' => 'Select Sale Status']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('💾 Save Sale', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
