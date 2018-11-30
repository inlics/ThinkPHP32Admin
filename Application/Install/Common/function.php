<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-09-10
 * Time: 16:36
 */

/**
 * 检测/判断环境是否可写
 * */
define('IS_WRITE', APP_MODE !== 'sea');

/**
 * 系统环境检测
 * @method chkEnv
 * @return array 系统环境数据（数组）
 * */
function chkEnv(){

    /* 检测内容：操作系统，PHP，上传，GD库，磁盘空间 */
    $env = array(
        'os'        => array('Operation System', '不限制', 'Linux/Unix', PHP_OS, 'success'),
        'php'       => array('PHP Version', '5.3', '5.3+', PHP_VERSION, 'success'),
        'upload'    => array('文件上传', '不限制', '2M+', '未知', 'success'),
        'gd'        => array('GD', '2.0', '2.0+', '未知', 'success'),
        'disk'      => array('存储空间', '5M', '不限制', '未知', 'success')
    );

    /* PHP版本必须大于等于5.3 */
    if($env['php'][3] < $env['php'][1]){
        $env['php'][4] = 'error';
        session('error',true);
    }

    /* 附件上传 */
    if(@ini_get('file_uploads')){
        $env['upload'][3] = ini_get('upload_max_filesize');
    }

    /* GD库是否启用 */
    $temp = function_exists('gd_info') ? gd_info() : array();

    if(empty($temp['GD Version'])){
        $env['gd'][3] = '未安装';
        $env['gd'][4] = 'error';
        session('error', true);
    }else{
        $env['gd'][3] = $temp['GD Version'];
    }

    /* 释放$temp */
    unset($temp);

    /* 磁盘余量 */
    if(function_exists('disk_free_space')){
        $env['disk'][3] = floor(disk_free_space(INSTALL_APP_PATH) / (1024*1024)).' M';
    }

    return $env;

}

/**
 * 目录文件读写性检测
 * @method chkDirfile
 * @return array 读写性结果（数组）
 * */
function chkDirfile(){
    $rw = array(
        array('dir', '可写', 'success', './Uploads/Download'),
        array('dir', '可写', 'success', './Uploads/Picture'),
        array('dir', '可写', 'success', './Uploads/Editor'),
        array('dir', '可写', 'success', './Application/Runtime'),
        array('dir', '可写', 'success', './Application/Install/Conf'),
        array('file', '可写', 'success', './Application/Common/Conf/Config.php')
    );

    foreach($rw as &$value) {
        if('dir' == $value[0]) {
            if(!is_writable(INSTALL_APP_PATH.$value[3])) {
                if(is_dir($value[3])){
                    $value[1] = '目录存在但不可写';
                    $value[2] = 'error';
                    session('error', true);
                } else {
                    $value[1] = '目录不存在';
                    $value[2] = 'error';
                    session('error', true);
                }
            }
        } else {
            if(file_exists(INSTALL_APP_PATH.$value[3])) {
                if(!is_writable(INSTALL_APP_PATH.$value[3])) {
                    $value[1] = '文件存在但不可写';
                    $value[2] = 'error';
                    session('error', true);
                }
            } else {
                if(!is_writable(dirname(INSTALL_APP_PATH.$value[3]))) {
                    $value[1] = '文件不存在';
                    $value[2] = 'error';
                    session('error', true);
                }
            }
        }
    }
    return $rw;
}

/**
 * 检测需要的函数是否可用
 * @method chkFunctions
 * @return array 读写性结果（数组）
 * */
function chkFunctions(){
    $funcs = array(
        array('mysqli_connect', '支持', 'success'),
        array('file_get_contents', '支持', 'success'),
        array('mb_strlen', '支持', 'success')
    );

    foreach($funcs as $val){
        if(!function_exists($val[0])){
            $val[1] = '不支持';
            $val[2] = 'error';
            $val[3] = '开启';
            session('error', true);
        }
    }

    return $funcs;
}

/**
 * 创建数据表
 * @method createTables
 * @param resource $db
 * @param string $prefix
 * */
function createTables($db, $prefix) {
    /*  */
    $sql = file_get_contents(MODULE_PATH.'Data/install.sql');
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    $original = C('ORIGINAL_TABLE_PREFIX');
    $sql = str_replace($original, $prefix, $sql);

    echo '开始安装数据库 ..';

    foreach($sql as $val) {
        $val = trim($val);
        if(empty($val))
            continue;
        if(substr($val, 0, 12) == 'CREATE TABLE') {
            $name = preg_replace("/^CREATE TABLE `(\w+)` . */s", "\\1", $val);
            $msg = "创建数据表 {$name}";
            if(false !== $db->execute($val)) {
                echo $msg.'..success';
            } else {
                echo $msg.'..error';
                session('error', true);
            }
        } else {
            $db->execute($val);
        }
    }
}

/**
 * 注册管理员
 * @method registAdmin
 * @param object $db
 * @param string $prefix
 * @param array $admin
 * @param string $auth
 * */
function registAdmin($db, $prefix, $admin, $auth) {
    echo '开始创建管理员';
    $username = $admin['username'];
    $password = customerMd5($admin['password'], $auth);
    $email = $admin['email'];
    $time = NOW_TIME;
    $ip = get_client_ip();

    /*$sql = "INSERT INTO `[PREFIX]ucenter_member` VALUES ('1','[NAME]','[PASS]','[EMAIL]','','0','[TIME]','[IP]','0','[TIME]','1', '0')";
    $sql = str_replace(
        array('[PREFIX]', '[NAME]', '[PASS]','[EMAIL]','[TIME]','[IP]'),
        array($prefix, $username, $password, $email, $time, $ip),
        $sql);
    $db->execute($sql);

    $sql = "INSERT INTO `[PREFIX]member` VALUES ('1','[NAME]', '0.00', '','0', '', '', '0', '0', '[IP]', '[TIME]', '[IP]', '[TIME]', '1')";
    $sql = str_replace(
        array('[PREFIX]', '[NAME]', '[TIME]', '[IP]'),
        array($prefix, $username, NOW_TIME, $ip),
        $sql);
    $db->execute($sql);*/

    $sql = "INSERT INTO `[PREFIX]user` VALUES ('1','[NAME]','[PWD]','1','[TIME]','[IP]','[EMAIL]', '[AUTH]', NULL)";
    $sql = str_replace(
        array('[PREFIX]', '[NAME]', '[PWD]', '[TIME]', '[IP]', '[EMAIL]', '[AUTH]'),
        array($prefix, $username, $password, NOW_TIME, $ip, $email, $auth),
        $sql);
    $db->execute($sql);

    echo '管理员创建完成';
}

/**
 * 设置应用配置文件
 * @method writeConfig
 * @param array $config 配置项
 * @param string $auth 随机串
 * @return string
 * */
function writeConfig($config, $auth) {
    if(is_array($config)) {
        $conf = file_get_contents(MODULE_PATH.'Conf/conf.txt');
        $user = file_get_contents(MODULE_PATH.'Conf/user.txt');

        foreach($config as $name => $value) {
            $conf = str_replace("[{$name}]", $value, $conf);
            $user = str_replace("[{$name}]", $value, $user);
        }

        $conf = str_replace('[AUTH_KEY]', $auth, $conf);
        $user = str_replace('[AUTH_KEY]', $auth, $user);

        if(!IS_WRITE) {
            return '您的配置文件不可写，请复制'.$conf.'里的内容到'.realpath(APP_PATH).'/User/Conf/config.php 内';
        } else {
            if(file_put_contents(APP_PATH.'Common/Conf/config.php',$conf)
                &&
               file_put_contents(APP_PATH.'User/Conf/config.php', $user)) {
                echo '写入成功';
            } else {
                echo '写入失败';
                session('error', true);
            }
            return '';
        }
    }
}