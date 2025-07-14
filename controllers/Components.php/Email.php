<?php

namespace app\components;

use Yii;
use yii\base\Component;

class Email extends Component
{
    public function send($to, $subject, $body)
    {
        return Yii::$app->mailer->compose()
            ->setTo($to)
            ->setFrom([Yii::$app->params['adminEmail'] => 'Inventory System']) // Update this email in params.php
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }
}
