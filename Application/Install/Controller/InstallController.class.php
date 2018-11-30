<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-09-10
 * Time: 16:21
 */

namespace Install\Controller;
use Think\Controller;
use Think\Db;
use Think\Storage;

class InstallController extends Controller {


    /**
     * @method _initialize
     * 根据install.lock文件是否存在判断是否已经安装该软件
     * */
    protected function _initialize() {
        if(Storage::has(MODULE_PATH.'Data/install.lock')) {
            $this->error(C('INSTALLED'));
        }
    }


    /**
     * 安装软件的第一步：环境检测
     * @method step_1
     * */
    public function stepOne() {
        session('error', false);

        /* 环境检测 */
        $env = chkEnv();

        /* 文件，目录读写检测 */
        if(IS_WRITE) {
            $dirfile = chkDirfile();
            $this->assign('dirfile', $dirfile);
        }

        /* 函数检测 */
        $func = chkFunctions();
        session('step', 1);

        $this->assign('env', $env);
        $this->assign('func', $func);
        $this->display();

    }


    /**
     * 安装软件的第二步：创建数据库
     * @method stepTwo
     * @param array $db
     * @param array $admin
     * */
    public function stepTwo($db = null, $admin = null) {
        if(IS_POST) {
            if(!is_array($admin) || empty($admin[0]) || empty($admin[1]) || empty($admin[2])) {
                $this->error('请完善管理员信息');
            } else if($admin[1] != $admin[2]) {
                $this->error('两次输入的管理员密码不一致');
            } else {
                $adminInfo = array();
                list($adminInfo['username'], $adminInfo['password'], $adminInfo['repassword'], $adminInfo['email'])
                    = $admin;
                session('admin_info', $adminInfo);
            }

            if(!is_array($db) || empty($db[0]) || empty($db[1]) || empty($db[2]) || empty($db[3])) {
                $this->error('请完善数据库信息');
            } else {
                $DB = array();
                list($DB['DB_TYPE'], $DB['DB_HOST'], $DB['DB_NAME'], $DB['DB_USER'], $DB['DB_PWD'], $DB['DB_PORT'],
                    $DB['DB_PREFIX']) = $db;
                session('db_config', $DB);

                $dbname = $DB['DB_NAME'];
                unset($DB['DB_NAME']);
                $db = Db::getInstance($DB);
                $sql = "CREATE DATABASE IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET utf8";
                $db->execute($sql) || $this->error($db->getError());

            }
            $this->redirect('stepThree');
        } else {
            session('error') && $this->error('环境检测未通过');

            $step = session('step');
            if($step != 1 && $step != 2) {
                $this->redirect('stepOne');
            }
            session('step', 2);
            $this->display();
        }
    }

    /**
     * 安装软件的第三步，导入数据表
     * @method stepThree
     * */
    public function stepThree() {
        /* 步骤二未完成 */
        if(session('step') != 2) {
            $this->redirect('stepTwo');
        }

        $this->display();

        /* 创建数据表 */
        $dbconfig = session('db_config');
        $db = Db::getInstance($dbconfig);
        createTables($db, $dbconfig['DB_PREFIX']);

        /* 创建管理员 */
        $auth = buildAuthKey(32,true);
        $admin = session('admin_info');
        registAdmin($db, $dbconfig['DB_PREFIX'], $admin, $auth);

        /* 写入配置信息 */
        /*$conf = writeConfig($dbconfig, $auth);
        session('config_file', $conf);*/
        if(session('error')) {

        } else {
            session('step', 3);
            $this->redirect('Index/complete');
        }
    }
}