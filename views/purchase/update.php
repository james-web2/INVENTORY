<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */

$this->title = $this->context->action->id === 'create'
    ? 'Create Purchase Order'
    : 'Update Purchase Order';

$this->params['breadcrumbs'][] = ['label' => 'Purchase Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="purchase-create text-white">
    <h2 class="mb-3"><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
