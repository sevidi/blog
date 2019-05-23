<?php


namespace post\forms\manage\User;

use post\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UserCreateForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $photo;
    public $last_name;
    public $first_name;
    public $birhday;
    public $password;
    public $role;

    public function rules(): array
    {
        return [
            [['username', 'email', 'phone', 'role'], 'required'],
            ['email', 'email'],
            [['username', 'email', 'last_name', 'first_name'], 'string', 'max' => 255],
            [['username', 'email', 'phone'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
            [['birhday'], 'date', 'format' => 'php:Y-m-d'],
            ['phone', 'integer'],
            [['photo'], 'image'],
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }

}