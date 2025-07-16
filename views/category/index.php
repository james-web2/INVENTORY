<?php
use yii\helpers\Html;

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;

// ✅ Register CSS for full-width layout
$this->registerCss(<<<CSS
body {
    background: #f0f2f5;
}

.category-index {
    padding: 50px 80px;
    font-family: 'Segoe UI', sans-serif;
    max-width: 100%;
}

.category-card {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background: #ffffff;
    border-radius: 12px;
    margin-bottom: 30px;
    padding: 30px;
    box-shadow: 0 8px 18px rgba(0,0,0,0.07);
    gap: 20px;
}

.category-info {
    flex: 1 1 65%;
    min-width: 300px;
}

.category-info h4 {
    font-size: 20px;
    margin-bottom: 8px;
    color: #1f2937;
}

.category-info p {
    font-size: 16px;
    margin: 4px 0;
    color: #4b5563;
}

.category-image {
    flex: 1 1 30%;
    max-width: 320px;
    min-width: 200px;
    height: 220px;
    overflow: hidden;
    border-radius: 12px;
    background: #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 12px;
    transition: transform 0.3s ease;
}

.category-image img:hover {
    transform: scale(1.05);
}

.category-actions {
    margin-top: 15px;
}

.category-actions .btn {
    margin-right: 10px;
}
CSS);
?>

<div class="category-index">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ Create Category', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="category-card">
            <div class="category-info">
                <h4><?= Html::encode($model->ProductName) ?> (ID: <?= Html::encode($model->id) ?>)</h4>
                <p><strong>Product ID:</strong> <?= Html::encode($model->ProductID) ?></p>
                <p><strong>Description:</strong> <?= Html::encode($model->ProductDescription) ?></p>
                <p><strong>Created Date:</strong> <?= Yii::$app->formatter->asDate($model->CreatedDate, 'php:Y-m-d') ?></p>
                <p><strong>Expiry Date:</strong> <?= Yii::$app->formatter->asDate($model->ExpiryDate, 'php:Y-m-d') ?></p>

                <div class="category-actions">
                    <?= Html::a('✏️ Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('🗑️ Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
                    ]) ?>
                </div>
            </div>

            <div class="category-image">
                <?php
                    $imagePath = Yii::getAlias('@webroot/' . $model->Image);
                    $imageUrl = Yii::getAlias('@web/' . $model->Image);

                    if (!empty($model->Image) && file_exists($imagePath)) {
                        echo Html::img($imageUrl, ['alt' => 'Product Image']);
                    } else {
                        echo "<span class='text-muted'>No image</span>";
                    }
                ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
