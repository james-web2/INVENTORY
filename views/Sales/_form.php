<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
?>
<div class="sale-form text-white">

    <?= $form->field($model, 'SaleDate')->input('date') ?>
    <?= $form->field($model, 'customer_id')->input('number') ?>
    <?= $form->field($model, 'CustomerName')->textInput() ?>
    <?= $form->field($model, 'total')->input('number', ['step' => '0.01']) ?>
    <?= $form->field($model, 'TotalAmount')->input('number', ['step' => '0.01']) ?>
    <?= $form->field($model, 'Status')->dropDownList([
            'Draft'    => 'Draft',
            'Pending'  => 'Pending',
            'Paid'     => 'Paid',
            'Cancelled'=> 'Cancelled',
        ]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class'=>'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
