<?php

/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-09-19
 * Time: 14:33
 */
class AesCrypt {
    /**
     * 加密请求数据
     * @method aesEncrypt
     * @param string $encryptKey 密钥
     * @param string $query 待加密数据
     * @return string
     * */
    public function aesEncrypt($encryptKey, $query) {
        return $this->encrypt($query, $encryptKey);
    }

    /**
     * 加密数据
     * @method encrypt
     * @param string $key 密钥
     * @param string $input 待加密数据
     * @return string
     * */
    public function encrypt($input, $key) {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $input = $this->pkcs5Pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        $iv = '0000000000000000';
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    /**
     * 填充长度到128位
     * @method pkcs5Pad
     * @param string $text
     * @param int $blocksize
     * @return string
     * */
    public function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text.str_repeat(chr($pad), $pad);
    }

    /**
     * 解密请求数据
     * @method aesDecrypt
     * @param string $encryptKey 密钥
     * @param string $data 待解密数据
     * @return string
     * */
    public function aesDecrypt($encryptKey, $data) {
        return $this->decrypt($data, $encryptKey);
    }
    /**
     * 解密数据
     * @method decrypt
     * @param string $sKey 密钥
     * @param string $sStr 待解密数据
     * @return string
     * */
    public function decrypt($sStr, $sKey) {
        $iv = '0000000000000000';
        $decrypted = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $sKey,
            base64_decode($sStr),
            MCRYPT_MODE_CBC,
            $iv
        );
        $decryptLength = strlen($decrypted);
        $padding = ord($decrypted[$decryptLength-1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }
}