<?php
namespace Wechat\Controller;
use Think\Controller;
vendor('Wechat.JsSDK');

class IndexController extends CommonController {

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
        /*echo '1';*/
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

    /**
     * 测试微信分享事件
     * @method shareTest
     * */
    public function shareTest() {
        $signPackage = $this->getSignPackage();
        $this->assign('signPackage', $signPackage);
        $this->display('shareTest');
    }

    public function createMenu() {
        $data = '{
                    "button": [
                        {
                            "type": "click",
                            "name": "今日歌曲",
                            "key": "V1001_TODAY_MUSIC"
                        },
                        {
                            "name": "菜单",
                            "sub_button": [
                                {
                                    "type": "view",
                                    "name": "搜索",
                                    "url": "http://www.soso.com/"
                                },
                                {
                                    "type": "click",
                                    "name": "赞一下我们",
                                    "key": "V1001_GOOD"
                                }
                            ]
                        }
                    ]
                }';
        $accessToken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$accessToken";
        $res = httpPost($url, $data);
        echo json_encode($res);
    }

}