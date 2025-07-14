<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .auth-container {
            display: flex;
            min-height: 100vh;
        }
        .auth-image {
            flex: 1;
            background: #f2f2f2;
        }
        .auth-form {
            flex: 1;
            padding: 40px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
