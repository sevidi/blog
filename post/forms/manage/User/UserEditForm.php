<?php


namespace post\forms\manage\User;

use post\entities\User\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UserEditForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $photo;
    public $last_name;
    public $first_name;
    public $birthday;
    public $role;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->last_name = $user->last_name;
        $this->first_name = $user->first_name;
        $this->birthday = $user->birthday;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        $this->role = $roles ? reset($roles)->name : null;
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'email', 'phone', 'role'], 'required'],
            ['email', 'email'],
            [['email', 'last_name', 'first_name'], 'string', 'max' => 255],
            ['phone', 'integer'],
            [['username', 'email', 'phone', 'birthday'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['photo'], 'image'],

        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
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