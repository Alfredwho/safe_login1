<?php
/**
 * Class RsaCrypt
 */
class RsaCrypt
{

    /**
     * @param $content
     * @return mixed
     * @throws \Exception
     * decrypt
     */
    public function decrypt($content) {
        $config = require __DIR__.'/../config/config.php';
        openssl_private_decrypt(base64_decode($content),$decryptResult,$config['privateKey']);
        if ($decryptResult) {
            return $decryptResult;
        }
        throw new \Exception('decode fail!');
    }
}
