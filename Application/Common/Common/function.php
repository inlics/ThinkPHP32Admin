<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-10-10
 * Time: 15:17
 */

/**
 * 生成随机字符串
 * @method buildAuthKey
 * @param number $len 随机串长度
 * @param boolean $isDifficult 是否加入特殊符号
 * @return string 返回打乱后截断的随机字符串
 * */
function buildAuthKey($len, $isDifficult) {
    /* 过滤掉容易混淆的字符 */
    $chars = 'abcdefhjkmnprstwxy345678ABCDEFGHJKLMNPQRSTWXY';
    if($isDifficult) {
        $chars .= '~!@#$%^&*()_+-=[]{};"|<>/?';
    }
    $chars = str_shuffle($chars);
    $len = $len ? $len : 32;
    return substr($chars, 0, $len);
}

/**
 * 双重加密
 * @method customerMd5
 * @param string $str 需要加密的字符串
 * @param string $key 盐
 * @return string 加密结果
 * */
function customerMd5($str, $key = '') {
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 发送http请求
 * @method httpPost
 * @param string $url 请求地址
 * @param string $data 提交的数据
 * @return object $res
 * */
function httpPost($url, $data) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}