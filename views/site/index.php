<?php
use yii\helpers\Html;

$search = Yii::$app->request->get('q'); // Ensure $search is defined
?>
<!-- Topbar -->
<div class="topbar" id="topbar">
    <?= Html::beginForm(['/site/index'], 'get', ['class' => 'd-flex align-items-center']) ?>
        <?= Html::input('text', 'q', $search, [
            'class' => 'form-control form-control-sm me-2',
            'placeholder' => 'Search products...',
        ]) ?>
        <?= Html::submitButton('Search', ['class' => 'btn btn-sm btn-primary']) ?>
    <?= Html::endForm() ?>

    <button id="toggleDark" class="btn btn-sm btn-dark ms-3">Dark Mode</button>
</div>

<?php if (!empty($search)): ?>
    <h4 class="mb-3 ms-3 text-muted">
        Search results for: <strong><?= Html::encode($search) ?></strong>
    </h4>
<?php endif; ?>

<style>
    .topbar {
        background-color: #f8f9fa;
        padding: 10px 20px;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .topbar form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .topbar input[type="text"] {
        width: 300px;
    }

    .topbar button {
        margin-left: 10px;
    }
</style>
