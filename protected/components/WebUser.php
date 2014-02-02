<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 02.02.14
 * Time: 15:27
 */
class WebUser extends CWebUser {

    const TYPE_GUEST = 'guest';
    const TYPE_USER = 'user';
    const TYPE_ROOT = 'root';
    const TYPE_MODERATOR = 'moderator';

    private $_access=array();


    public function login($identity,$duration=0) {
        $id=$identity->getId();
        $states=$identity->getPersistentStates();
        if($this->beforeLogin($id,$states,false)) {
            $this->changeIdentity($identity);

            if($duration>0) {
                if($this->allowAutoLogin)
                    $this->saveToCookie($duration);
                else
                    throw new CException(Yii::t('yii','{class}.allowAutoLogin must be set true in order to use cookie-based authentication.',
                        array('{class}'=>get_class($this))));
            }

            $this->afterLogin(false);
        }
    }


    protected function changeIdentity(UserIdentity $identity) {
        Yii::app()->getSession()->regenerateID();
        $this->setId($identity->getId());
        $this->setName($identity->getName());
        $this->setEmail($identity->getEmail());
        $this->setType($identity->getType());
        $this->loadIdentityStates($identity->getPersistentStates());
    }


    protected function restoreFromCookie() {
        $app=Yii::app();
        $cookie=$app->getRequest()->getCookies()->itemAt($this->getStateKeyPrefix());
        if($cookie && !empty($cookie->value) && ($data=$app->getSecurityManager()->validateData($cookie->value))!==false)
        {
            $data=@unserialize($data);
            if(is_array($data) && isset($data[0],$data[1],$data[2],$data[3]))
            {
                list($id,$name,$duration,$states)=$data;
                if($this->beforeLogin($id,$states,true)) {

                    $this->changeIdentity($id,$name,$states);
                    if($this->autoRenewCookie) {
                        $cookie->expire=time()+$duration;
                        $app->getRequest()->getCookies()->add($cookie->name,$cookie);
                    }
                    $this->afterLogin(true);
                }
            }
        }
    }


    public function getEmail() {
        return $this->getState('__email');
    }

    public function setEmail($value)    {
        $this->setState('__email',$value);
    }

    public function getType() {
        if(($name=$this->getState('__type'))!==null)
            return $name;
        else
            return self::TYPE_GUEST;
    }

    public function setType($value) {
        $this->setState('__type', $value);
    }

    public function checkAccess($operation,$params=array(),$allowCaching=true) {
        if($allowCaching && $params===array() && isset($this->_access[$operation]))
            return $this->_access[$operation];
        else
            return $this->_access[$operation]=Yii::app()->getAuthManager()->checkAccess($operation,$this->getType(),$params);
    }

}