<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel {
    public $name;
    public $pass;
    public $pass2;
    public $email;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('name, pass, pass2, email', 'required'),
            array('pass2', 'compare', 'compareAttribute'=>'pass'),
            array('name, pass, pass2', 'length', 'min'=>'5', 'max'=>32),
            array('name', 'unique', 'className' => 'Users', 'attributeName' => 'name'),
            array('email', 'unique', 'className' => 'Users', 'attributeName' => 'email'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Фимилия Имя',
            'email' => 'EMail',
            'pass' => 'Введите пароль',
            'pass2' => 'Повторите пароль',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function register() {
        $user = new Users();
        $user->email = $this->email;
        $user->pass = $user->getHashOfPassword($this->pass);
        $user->name = $this->name;
        $user->type = Users::TYPE_USER;
        if (!$user->save()) {
            return false;
        }
        $identity = new UserIdentity($this->email, $this->pass);
        $identity->authenticate();
        return Yii::app()->user->login($identity, Users::TOKEN_EXPIRED);
    }
}
