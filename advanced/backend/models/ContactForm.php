<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    //trocar Nomes
    public $name;
    public $email;
    public $assunto;
    public $mensagem;
    public $verifyCode;
    public $select;
    public $emails_selecionados;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['assunto', 'mensagem','emails_selecionados'], 'required'],
            // email has to be a valid email address
            //['email', 'email'],
            // verifyCode needs to be entered correctly


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
       /* return [
            'verifyCode' => 'Verification Code',
        ];*/
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->assunto)
            ->setTextBody($this->mensagem)
            ->send();
    }

}
