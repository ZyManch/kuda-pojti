<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    const COOKIE_TOKEN_NAME = 'token_hash';
    public $token;
    public $type;
    public $email;
    public $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
        if (!trim($this->username) || !trim($this->password)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $user = Users::model()->findByAttributes(array(
                'email' => $this->username,
            ));
            /** @var Users $user */
            if ($user && $user->comparePassword($this->password)) {
                $this->username = $user->name;
                $this->setState('email', $user->email);
                $this->setState('type', $user->type);
                $this->_id = $user->id;
                $this->errorCode = self::ERROR_NONE;
            } else {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
        }
		return !$this->errorCode;
	}

    public function getEmail() {
        return $this->getState('email');
    }

    public function getType() {
        return $this->getState('type');
    }

    public function getId(){
        return $this->_id;
    }
}