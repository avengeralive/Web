<?php
class Melbet_Mbut5
{

	public $key;
	protected $cipher;
	 
	public function __construct($key = '', $cipher ='AES-128-CBC')
	{

		$this->cipher = $cipher;
		$this->key = $key;
	}
	 
    public function decrypt($data)
    {
        $data = base64_decode($data);
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = substr($data, 0, $ivlen);
        $hmac = substr($data, $ivlen, $sha2len=32);
        $raw = substr($data, $ivlen+$sha2len);
        $text = openssl_decrypt($raw, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $raw, $this->key, true);
        
        if (hash_equals($hmac, $calcmac))
        {

            return $text;
        }
    }
}
?>