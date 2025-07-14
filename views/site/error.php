<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $exception Exception */

$this->title = 'Error';
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($exception->getMessage())) ?>
    </div>
</div>
