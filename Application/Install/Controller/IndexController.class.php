<?php
namespace Install\Controller;
use Think\Controller;
use Think\Storage;

class IndexController extends Controller {

    /**
     * @method index
     * 软件安装首页
     * */
    public function index() {
        if(Storage::has(MODULE_PATH.'Data/install.lock')) {
            // $this->error('已经安装了，请不要重复安装', U('Admin/Index/index'));
            // $this->redirect('Admin/Index/index', '3');
            // $this->redirect('Admin/Index', array('cate_id' => 2), 5, '页面跳转中...');
            $this->success('已经安装了，请不要重复安装', __ROOT__, 3);
        } else {
            session_destroy();
            session_start();

            session('step', 0);
            session('error', false);
            // $this->assign('step', session('step'));
            $this->display();
        }
    }

    /**
     * 安装完成
     * @method complete
     * */
    public function complete() {
        $step = session('step');

        if(!$step) {
            $this->redirect('index');
        } elseif($step != 3) {
            switch($step) {
                case 1:
                    $step = 'One';
                    break;
                case 2:
                    $step = 'Two';
                    break;
                default:
                    $step = 'Two';
                    break;
            }
            $this->redirect("Install/step{$step}");
        }

        Storage::put(MODULE_PATH.'Data/install.lock', 'lock in '.get_client_ip());
        $this->assign('info', session('config_file'));
        session('step', null);
        session('error', null);
        $this->display();
    }
}