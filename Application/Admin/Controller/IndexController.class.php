<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    /**
     * 跳转到后台首页
     * @method index
     * */
    public function index() {
        $source = '2815391962';
        $url_long = 'http://www.baidu.com/';
        $url_short = getSinaShortUrl($source, $url_long);
        $this->assign('shturl', $url_short);
        // $accessData = M('access')->where(array('role_id'=>$rid))->getField('node_id', true);
        $this->assign('nodeData', getNode());
        $this->display();
    }

    /**
     * 后台首页（）
     * @method welcome
     * */
    public function welcome() {
        $this->display();
    }

    /**
     * 尝试调用其他模块
     * @method wechat
     * */
    public function wechat() {
        // $wechat = A('Wechat/Index');
        // var_dump($wechat);
        // $wechat->shareTest();
        // $wechat = A('Wechat/Index');
        // $wechat->display('Wechat/Index/shareTest');
        // $wx = A('Wechat/Index');
        // $wx = new \Wechat\Controller\IndexController();
        // $accessToken = $wx->getAccessToken();
        // $wx->display('Wechat/Index/shareTest');
    }

}