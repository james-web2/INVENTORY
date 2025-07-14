<?php
use yii\helpers\Html;

/** @var \yii\web\View $this view component instance */
/** @var \yii\mail\MessageInterface $message the message being composed */
/** @var string $content main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style>
    <?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Paste Bootstrap CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>

    <?= $content ?>

    <!-- Paste Bootstrap JS here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }
    h1 {
        color: #333;
    }
    p {
        color: #555;
    }
    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    <section class="about-section">
  <h1>About Us</h1>
  <p>We are passionate about delivering quality services and building strong relationships with our clients.</p>
  <button class="btn-primary">Learn More</button>
</section>
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    <head>
  <style>
    /* Paste your CSS code here */
    .about-section {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      text-align: center;
      color: #333;
    }

    .about-section h1 {
      color: #2c3e50;
      font-size: 36px;
      margin-bottom: 15px;
    }

    .about-section p {
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 25px;
      color: #555;
    }

    .btn-primary {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 12px 30px;
      font-size: 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>
</head>

</style>

