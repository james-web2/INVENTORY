
<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About Us';
$this->params['breadcrumbs'][] = $this->title;
$baseUrl = Yii::getAlias('@web');
$params = Yii::$app->params;
?>

<style>
.about-section {
    background: linear-gradient(135deg, #f0f8ff, #e6f2ff);
    padding: 50px;
    border-radius: 10px;
    animation: fadeInUp 1s ease-in-out;
}

.about-card {
    max-width: 900px;
    margin: auto;
    background: #ffffff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    padding: 40px;
    animation: slideIn 1.2s ease;
}

.about-card h2 {
    font-size: 32px;
    color: #2c3e50;
    margin-bottom: 20px;
}

.about-card p,
.about-card li {
    font-size: 17px;
    line-height: 1.6;
    color: #555;
}

.about-card ul {
    padding-left: 20px;
    margin-bottom: 25px;
}

.about-card h4 {
    margin-top: 30px;
    color: #1e2a38;
    font-size: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.about-footer {
    text-align: center;
    margin-top: 40px;
    font-size: 15px;
    color: #888;
    animation: fadeIn 2s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

<div class="about-section">
    <div class="about-card">
        <h2>Welcome to SmartInventory Solutions</h2>

        <p>
            <strong>SmartInventory Solutions</strong> is a leading provider of modern inventory management systems. Our mission is to help businesses in Kenya and beyond streamline their inventory processes and grow their operations with confidence.
        </p>

        <p>
            With cutting-edge tools, user-friendly design, and real-time insights, our platform is trusted by businesses across industries to manage products, track stock, generate insightful reports, and optimize supply chains.
        </p>

        <h4>Why Choose Us?</h4>
        <ul>
            <li>Accurate inventory tracking</li>
            <li>Real-time dashboards and reports</li>
            <li>Easy-to-use web interface</li>
            <li>Responsive customer support</li>
        </ul>

        <h4>Our Vision</h4>
        <p>
            Our vision is to empower businesses with the tools they need to succeed in a competitive market. We believe that efficient inventory management is key to operational excellence and customer satisfaction.
        </p>

        <h4>Our Team</h4>
        <p>
            Our team consists of experienced professionals in software development, inventory management, and customer support. We are dedicated to providing the best solutions and services to our clients.
        </p>

        <h4>Our Achievements</h4>
        <p>
            Since our inception, we have successfully helped over 500 businesses optimize their inventory processes, reduce costs, and improve customer satisfaction. Our platform has been recognized for its innovation and effectiveness in the industry.
        </p>

        <h4>Contact Information</h4>
        <p>
            📍 Location: <strong>Moi Avenue, Nairobi, Kenya</strong><br>
            ✉️ Email: <a href="mailto:info@smartinventory.com">info@smartinventory.com</a><br>
            ☎️ Phone: +254 793808108
        </p>

        <h4>Our Location on the Map</h4>
        <iframe 
            src="https://www.google.com/maps?q=Nairobi,+Kenya&output=embed" 
            width="100%" 
            height="300" 
            frameborder="0" 
            style="border:0; border-radius: 10px;" 
            allowfullscreen="" 
            aria-hidden="false" 
            tabindex="0">
        </iframe>

        <p class="about-text mt-4">
            <strong>Contact Support:</strong><br>
            📧 <?= Html::encode($params['adminEmail']) ?><br>
            📞 <?= Html::encode($params['supportPhone']) ?>
        </p>

        <div class="about-footer">
            &copy; <?= date('Y') ?> <?= Html::encode($params['companyName']) ?> | Version <?= Html::encode($params['systemVersion']) ?>
        </div>
    </div>
</div>
