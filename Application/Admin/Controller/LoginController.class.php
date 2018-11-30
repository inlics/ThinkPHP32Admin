<?php
namespace Admin\Controller;
use Org\Util\Rbac;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller {

    /**
     * 后台用户登录
     * @method index
     * */
    public function index(){
        if(IS_POST) {
            $verify = new Verify();
            if($verify->check(I('post.vcode'))) {
                $userModel = D('User');
                $user = $userModel->checkLogin(I('post.name'), I('post.password'));
                if($user) {
                    session(C('USER_AUTH_KEY'), $user['id']);
                    session('username', $user['name']);

                    if($user['name'] == C('RBAC_SUPERADMIN')) {
                        session(C('ADMIN_AUTH_KEY'), true);
                    }

                    Rbac::saveAccessList();
                    $this->success('登录成功，请稍候', U('index/index'), 2);
                } else {
                    $this->error('用户名或密码错误，请重试');
                }
            } else {
                $this->error('验证码错误，请刷新验证码');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 后台用户退出登录
     * @method logout
     * */
    public function logout() {
        session(null);
        $this->success('已安全退出',U('index'),1);
    }

    /**
     * 创建图片验证码
     * @method verifyCode
     * */
    public function verifyCode() {
        $config = array(
            'useImgBg' => false,            // 使用背景图片
            'fontSize' => 18,              // 验证码字体大小(px)
            'useCurve' => true,            // 是否画混淆曲线
            'useNoise' => false,           // 是否添加杂点
            'imageH'   => 34,              // 验证码图片高度
            'imageW'   => 130,             // 验证码图片宽度
            'length'   => 4,               // 验证码位数
            'fontttf'  => '',              // 验证码字体，不设置随机获取
            'bg'       => array(243, 251, 254),  // 背景颜色
            'reset'    => true,           // 验证成功后是否重置
        );
        $verify = new Verify($config);
        $verify->entry();
    }
}