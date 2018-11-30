<?php
function p($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

return array(
    #默认分组设置
    'DEFAULT_MODULE'        => 'Home',     //默认模块
    'MODULE_ALLOW_LIST'     => array('Home','Admin'), //定义可供访问的分组列表
    'URL_CASE_INSENSITIVE'  => false,         //不区分URL大小写后
    'SHOW_PAGE_TRACE'       => false,        //显示页面跟从信息
    'URL_MODEL'             => 1,

    #数据库设置
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  '',    // 数据库名
    'DB_USER'               =>  '',      // 用户名
    'DB_PWD'                =>  '',         // 密码
    'DB_PORT'               =>  '',          // 端口默认3306
    'DB_PREFIX'             =>  'tb_',      // 数据库表前缀
    'DB_PARAMS'          	=>  array(),     // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE,        // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    #RBAC配置
    "USER_AUTH_ON" => true,                    //是否开启权限验证(必配)
    "USER_AUTH_TYPE" => 1,                     //验证方式（1、实时验证；2、登录验证）
    "USER_AUTH_KEY" => 'userid',               //用户认证识别号(必配)
    "ADMIN_AUTH_KEY" => 'superadmin',          //超级管理员识别号(必配)
    "USER_AUTH_MODEL" => '',                   //验证用户表模型 ly_user
    'USER_AUTH_GATEWAY'  =>  '',               //用户认证失败，跳转URL
    'AUTH_PWD_ENCODER'=>'md5',                 //默认密码加密方式
    "RBAC_SUPERADMIN" => 'admin',              //超级管理员名称
    "NOT_AUTH_MODULE" => 'Index,Login',  //无需认证的模块(controller)
    'REQUIRE_AUTH_MODULE' =>  '',              //默认需要认证的模块
    'REQUIRE_AUTH_ACTION' =>  '',              //默认需要认证的动作
    'GUEST_AUTH_ON'   =>  false,               //是否开启游客授权访问
    'GUEST_AUTH_ID'   =>  0,                   //游客标记
    "RBAC_ROLE_TABLE" => 'tb_role',         //角色表名称(必配)
    "RBAC_USER_TABLE" => 'tb_role_user',    //用户角色中间表名称(必配)
    "RBAC_ACCESS_TABLE" => 'tb_access',     //权限表名称(必配)
    "RBAC_NODE_TABLE" => 'tb_node',         //节点表名称(必配)

    'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/jump.tpl', // 默认错误跳转对应的模板文件

    'WX_APPID' => '', // 微信公众号开发者ID
    'WX_APPSECRET' => '', // 微信公众号开发者密码
    'WX_TOKEN' => '', // 微信配置服务器时需要检验的token
    'TEST_WX_APPID' => '', // 微信测试号开发者ID
    'TEST_WX_APPSECRET' => '' // 为西南测试号开发者密码
);