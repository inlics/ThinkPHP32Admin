<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-10-12
 * Time: 11:10
 */

namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller {

    /**
     * 接入微信服务器第一步：校验echostr
     * @method index
     * */
    public function index() {
        $echostr = I('get.echostr');
        if($this->chkSignature()) {
            echo $echostr;
            exit;
        }
    }

    /**
     * 校验微信服务器请求时签名参数
     * @method chkSignature
     * */
    public function chkSignature() {
        $signature = I('get.signature');
        $timestamp = I('get.timestamp');
        $nonce = I('get.nonce');
        $token = C('WX_TOKEN');
        $tempArr = array($token, $timestamp, $nonce);
        sort($tempArr, SORT_STRING);
        $tempStr = implode($tempArr);
        $tempStr = sha1($tempStr);

        if($tempStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}