<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $username;
    public $email;
    public $photo;
    public $file;
    public $password_hash;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 100],
            
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Ya existe este usuario.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Ya existe un usuario con este email.'],
            
            [['file'], 'image', 'extensions' => 'png,jpg,jpeg'],
            [['photo', 'file'], 'required', 'on' => 'create'],
            [['photo'], 'string', 'max' => 255],

            ['password_hash', 'required'],
            ['password_hash', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->name = $this->name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->photo = $this->photo;
            $user->setPassword($this->password_hash);
            $user->generateAuthKey();
            
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
