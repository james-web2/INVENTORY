<main class="container">
    <h1 class="mt-4">Dashboard</h1>
    <p>You are successfully logged in!</p>
    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="ordersChart" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="stockChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Orders Chart
    const ctxOrders = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctxOrders, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Orders',
                data: [150, 200, 180, 220, 240, 260], // YOUR data
                backgroundColor: 'rgba(13, 110, 253, 0.2)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 2,
                tension: 0.4
            }]
        }
    });

    // Stock Chart
    const ctxStock = document.getElementById('stockChart').getContext('2d');
    new Chart(ctxStock, {
        type: 'doughnut',
        data: {
            labels: ['Electronics', 'Furniture', 'Others'],
            datasets: [{
                label: 'Stock',
                data: [60, 25, 15], // YOUR data
                backgroundColor: [
                    'rgba(13, 110, 253, 0.7)',
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(255, 193, 7, 0.7)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>