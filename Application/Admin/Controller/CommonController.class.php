<?php
namespace Admin\Controller;
use Org\Util\Rbac;
use Think\Controller;
class CommonController extends Controller {

    public function _initialize() {
        if(!isset($_SESSION[c('USER_AUTH_KEY')])) {
            $this->error('您还没有登录哦', U('Admin/Login/index'), 3);
        }

        /*$notauth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) ||
                   in_array(ACTION_NAME, explode(',', C('NOT_AUTH_MODULE')));
        if(C('USER_AUTH_ON') && !$notauth) {
            import('Org.Util.Rbac');
            if(!Rbac::AccessDecision(MODULE_NAME)) {
                // $this->ajaxReturn(array('err' => 1, 'msg' => 'no access', 'wait' => 2));
                $this->error('no access', 'Admin/Index/index');
            }
        }*/

        /*$notAuth = in_array(CONTROLLER_NAME,explode(',',C('NOT_AUTH_MODULE')))
            || in_array(ACTION_NAME,C('NOT_AUTH_ACTION'));
        if(C('USER_AUTH_ON') && !$notAuth) {
            //var_dump(Rbac::AccessDecision());
            Rbac::AccessDecision() || $this->error('您还没有登录哦', U('Admin/Index/index'), 3);;
        }*/
    }
}