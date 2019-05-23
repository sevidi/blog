<?php


namespace post\forms\User;

use post\entities\User\User;
use yii\base\Model;
use yii\web\UploadedFile;


class ProfileEditForm extends Model
{
    public $username;
    public $phone;
    public $photo;
    public $last_name;
    public $first_name;
    public $birthday;
    public $email;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->photo = $user->photo;
        $this->last_name = $user->last_name;
        $this->first_name = $user->first_name;
        $this->birthday = $user->birthday;
        $this->email = $user->email;
        $this->_user = $user;
        parent::__construct($config);
    }
    public function rules(): array
    {
        return [
            [['phone', 'email'], 'required'],
            ['email', 'email'],
            [['email', 'last_name', 'first_name'], 'string', 'max' => 255],
            [['phone'], 'integer'],
            [['phone', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['photo'], 'image'],
        ];
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