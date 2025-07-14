<?php
use yii\helpers\Html;

$this->title = 'Create Purchase Order';
?>
<h2 class="text-white"><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form', ['model' => $model]) ?>
