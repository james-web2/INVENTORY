<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Products';
?>

<div class="container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Add Product', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'category',
            'quantity',
            'price',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <div class="mt-5">
        <h2>Product Quantity by Category</h2>
        <canvas id="productChart" width="400" height="200"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('productChart').getContext('2d');

    const chartData = {
        labels: <?= json_encode(array_keys($categoryData)) ?>,
        datasets: [{
            label: 'Quantity',
            data: <?= json_encode(array_values($categoryData)) ?>,
            backgroundColor: [
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const productChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: {
                    display: true,
                    text: 'Products by Category'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
