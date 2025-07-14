<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
?>
<div class="purchase-form text-white">

    <?= $form->field($model, 'Reference')->textInput() ?>
    <?= $form->field($model, 'Supplier')->textInput() ?>
    <?= $form->field($model, 'Branch')->textInput() ?>
    <?= $form->field($model, 'date')->input('date') ?>
    <?= $form->field($model, 'ExpectedDelivery')->input('date') ?>
    <?= $form->field($model, 'Status')
             ->dropDownList(['Draft'=>'Draft','Pending'=>'Pending','Received'=>'Received']) ?>
    <?= $form->field($model, 'Amount')->textInput(['type'=>'number','step'=>'0.01']) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class'=>'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
