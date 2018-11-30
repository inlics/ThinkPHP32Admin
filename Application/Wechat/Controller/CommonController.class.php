<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-10-12
 * Time: 16:59
 */

namespace Wechat\Controller;
use Think\Controller;
vendor('Wechat.JsSDK');

class CommonController extends Controller {

    /**
     * 获取微信jsapi_ticket
     * @method getSignPackage
     * */
    public function getSignPackage() {
        $JSSDK = new \JsSDK(C('TEST_WX_APPID'), C('TEST_WX_APPSECRET'));
        $signPackage = $JSSDK->getSignPackage();
        return $signPackage;
    }
    /**
     * 获取微信access_token
     * @method getSignPackage
     * */
    public function getAccessToken() {
        $JSSDK = new \JsSDK(C('TEST_WX_APPID'), C('TEST_WX_APPSECRET'));
        $accessToken = $JSSDK->getAccessToken();
        return $accessToken;
    }

}