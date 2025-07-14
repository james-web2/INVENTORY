<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    // ✅ Add public imageFile property for file upload
    public $imageFile;

    public static function tableName()
    {
        return 'Users'; // Ensure your DB table is named 'Users'
    }

    public function rules()
    {
        return [
            [['email', 'password_hash', 'auth_key', 'role'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['role', 'in', 'range' => ['admin', 'manager', 'customer']],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'password_hash', 'auth_key', 'password_reset_token', 'role', 'name', 'image'], 'string', 'max' => 255],

            // ✅ Add validation for file upload
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function scenarios()
    {
        return [
            'default' => ['email', 'password_hash', 'auth_key', 'role', 'status', 'created_at', 'updated_at', 'name'],
            'create' => ['email', 'password_hash', 'auth_key', 'role'],
            'update' => ['email', 'role', 'name', 'imageFile'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password_hash' => 'Password',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'image' => 'Profile Picture',
            'imageFile' => 'Upload Profile Picture',
        ];
    }

    // IdentityInterface methods
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
