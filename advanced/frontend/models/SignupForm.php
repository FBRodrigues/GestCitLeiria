<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $TipoUtilizador;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['TipoUtilizador', 'required'],
            ['TipoUtilizador', 'string', 'max' => 1]
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
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->TipoUtilizador = $this->TipoUtilizador;
            $user->generateAuthKey();
            if($this->TipoUtilizador == 'T'){
                //cria treinador
                $modelT = new Treinador();
                $modelT->Nome = $this->username;
                $modelT->Id_User = $user->id;

                $modelT->save();

                if ($user->save()) {
                    return $user;
                }
            }else if($this->TipoUtilizador == 'A'){
                //cria aluno
                $modelA = new Aluno();
                $modelA->Nome = $this->username;
                $modelA->Contato3_Email = $this->email;
                $modelA->Id_User = $user->id;

                $modelA->save();

                if ($user->save()) {
                    return $user;
                }
            }
//            if ($user->save()) {
//                return $user;
//            }
        }

        return null;
    }
}
