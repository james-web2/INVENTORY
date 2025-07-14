<?php
use yii\helpers\Html;
$this->title = 'Create Sale';
?>
<h2 class="text-white"><?= Html::encode($this->title) ?></h2>
<?= $this->render('_form', ['model' => $model]) ?>
