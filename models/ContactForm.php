<?php

namespace app\models;

use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Your Name',
            'email' => 'Email Address',
            'subject' => 'Subject',
            'body' => 'Message',
        ];
    }
}
