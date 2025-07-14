<?php
use yii\helpers\Html;

$this->title = 'Terms and Conditions';
?>

<div class="container" style="padding: 40px; background: #fff; border-radius: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Effective Date: <?= date('F j, Y') ?></p>

    <h3>1. Introduction</h3>
    <p>Welcome to the SmartStock Inventory Management System. These Terms and Conditions outline the rules and regulations for the use of our system. By registering or using the platform, you agree to these terms.</p>

    <h3>2. User Accounts</h3>
    <p>All users are responsible for maintaining the confidentiality of their login credentials. Users must provide accurate, current, and complete information during registration.</p>

    <h3>3. Data and Privacy</h3>
    <p>We take your data seriously. Your personal information is handled according to our Privacy Policy. We do not sell, share, or misuse your information.</p>

    <h3>4. Use of the System</h3>
    <ul>
        <li>You may only use the system for lawful purposes.</li>
        <li>Do not misuse or attempt to exploit system vulnerabilities.</li>
        <li>Respect other users and the integrity of the platform.</li>
    </ul>

    <h3>5. Termination</h3>
    <p>We reserve the right to suspend or delete accounts that violate these terms or abuse the system.</p>

    <h3>6. Modifications</h3>
    <p>We may update these Terms and Conditions at any time. You will be notified of significant changes.</p>

    <h3>7. Contact Us</h3>
    <p>If you have any questions about these Terms and Conditions, please contact us at:</p>
    <p>Email: support@smartstock.com<br>Phone: +254 7938 081 08</p>

    <hr>
    <p><em>Thank you for using SmartStock Inventory System.</em></p>
</div>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f4f4f4;
        padding: 20px;
    }
    h1, h3 {
        color: #333;
    }
    p {
        color: #555;
    }
    ul {
        margin-left: 20px;
    }