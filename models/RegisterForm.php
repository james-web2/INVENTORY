<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use Yii;

class RegisterForm extends Model
{
    public $email;
    public $password;
    public $role;

    public function rules()
    {
        return [
            [['email', 'password', 'role'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email', 'message' => 'This email is already registered.'],
            ['role', 'in', 'range' => ['admin', 'manager', 'customer']],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);

        if ($user->save()) {
            return $user;
        }

        $this->addErrors($user->getErrors());
        return false;
    }
}
