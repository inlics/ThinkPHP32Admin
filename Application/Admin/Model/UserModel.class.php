<?php

/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-10-09
 * Time: 17:40
 */
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {

    protected $tableName = 'user';

    public function checkLogin($name, $pwd) {
        $user = $this->where("name='$name'")->find();
        if($user) {
            if($user['password'] == customerMd5($pwd, $user['auth'])) {
                return $user;
            }
        }
        return null;
    }

}