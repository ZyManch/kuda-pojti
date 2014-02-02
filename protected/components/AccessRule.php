<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 11.12.12
 * Time: 9:58
 */
class AccessRule extends CAccessRule {
    /**
     * @param IWebUser $user the user object
     * @return boolean whether the rule applies to the role
     */
    protected function isRoleMatched($user) {
        if(empty($this->roles))
            return true;
        foreach($this->roles as $key=>$role) {
            if($user->checkAccess($key,$role)) {
                return true;
            }
        }
        return false;
    }
}