<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerCss(<<<CSS
    .purchase-form {
        background-color: #558fc9ff;
        color: white;
        border-radius: 10px;
        padding: 40px 30px;
        width: 100%;
        margin: 0 auto 30px auto;
        animation: fadeIn 0.5s ease-in-out;
    }

    .purchase-form h3 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
        color: white;
    }

    .purchase-form .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #dee2e6;
    }

    .purchase-form .form-label {
        font-weight: 600;
    }

    .form-group button {
        width: 100%;
        padding: 12px;
        font-weight: bold;
        font-size: 16px;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(10px);}
        to   {opacity: 1; transform: translateY(0);}
    }
CSS);
?>

<?php $form = ActiveForm::begin(); ?>
<div class="container-fluid">
    <div class="purchase-form">

        <h3>🛒 Create / Update Purchase Order</h3>

        <div class="row mb-3">
            <div class="col-md-6">
                <?= $form->field($model, 'Reference')->textInput(['placeholder' => 'Enter reference']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'Supplier')->textInput(['placeholder' => 'Enter supplier name']) ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <?= $form->field($model, 'Branch')->textInput(['placeholder' => 'Enter branch']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'Status')->dropDownList([
                    'Draft' => 'Draft',
                    'Pending' => 'Pending',
                    'Received' => 'Received'
                ], ['prompt' => 'Select Status']) ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <?= $form->field($model, 'date')->input('date') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'ExpectedDelivery')->input('date') ?>
            </div>
        </div>

        <div class="mb-3">
            <?= $form->field($model, 'Amount')->textInput([
                'type' => 'number',
                'step' => '0.01',
                'placeholder' => 'Enter amount'
            ]) ?>
        </div>

        <div class="form-group mt-4">
            <?= Html::submitButton('💾 Save Purchase', ['class' => 'btn btn-warning text-dark']) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
