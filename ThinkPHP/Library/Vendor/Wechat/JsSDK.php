<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-10-12
 * Time: 17:03
 */
class JsSDK {

    private $appId; // 开发者ID
    private $appSecret; // 开发者密码


    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * 打包微信签名数据
     * @method getSignPackage
     * @return array $signPackage
     * */
    public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );

        return $signPackage;
    }

    /**
     * 生成nonce字符串
     * @method createNonceStr
     * @param int $length nonce字符串长度
     * @return string nonce
     * */
    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        for($i=0; $i<$length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * 根据access_token获取jsApiTicket
     * @method getJsApiTicket
     * @return string $ticket
     * */
    private function getJsApiTicket() {
        $data = json_decode(file_get_contents("./Application/Wechat/Data/jsapi_ticket.json"));
        if($data->expire_time<time()) {
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpRequest($url));
            $ticket = $res->ticket;
            if($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen("./Application/Wechat/Data/jsapi_ticket.json", 'w');
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }

    /**
     * 根据appId和appSecret获取access_token
     * @method getAccessToken
     * @return string $access_token
     * */
    public function getAccessToken() {
        $data = json_decode(file_get_contents("./Application/Wechat/Data/access_token.json"));
        if($data->expire_time<time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
            $res = json_decode($this->httpRequest($url));
            $access_token = $res->access_token;
            if($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("./Application/Wechat/Data/access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    /**
     * 发送http请求
     * @method httpRequest
     * @param string $url 请求地址
     * @return object
     * */
    private function httpRequest($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}