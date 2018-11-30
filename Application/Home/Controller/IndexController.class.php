<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $wx = new \Wechat\Controller\CommonController();
        $signPackage = $wx->getSignPackage();
        $this->assign('signPackage', $signPackage);
        $this->display();
    }
}