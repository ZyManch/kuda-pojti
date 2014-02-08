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


    public function getEmail() {
        return $this->getState('email');
    }

    public function setEmail($value)    {
        $this->setState('email',$value);
    }

    public function getType() {
        if(($name=$this->getState('type'))!==null)
            return $name;
        else
            return self::TYPE_GUEST;
    }

    public function setType($value) {
        $this->setState('type', $value);
    }

    public function checkAccess($operation,$params=array(),$allowCaching=true) {
        if($allowCaching && $params===array() && isset($this->_access[$operation]))
            return $this->_access[$operation];
        else
            return $this->_access[$operation]=Yii::app()->getAuthManager()->checkAccess($operation,$this->getType(),$params);
    }

}