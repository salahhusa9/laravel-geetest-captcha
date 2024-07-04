<?php

namespace Salahhusa9\GeetestCaptcha;

class GeetestCaptcha
{
    private $captcha_id;

    private $captcha_key;

    private $api_server;

    private $validatedData;

    public function __construct()
    {
        $this->captcha_id = env('GEETEST_ID');
        $this->captcha_key = env('GEETEST_KEY');
        $this->api_server = 'http://gcaptcha4.geetest.com';
    }

    public function validate($value)
    {
        $captcha_id = env('GEETEST_ID');
        $captcha_key = env('GEETEST_KEY');
        $api_server = 'http://gcaptcha4.geetest.com';

        if (empty($value)) {
            return false;
        }

        $value = json_decode($value, true);
        // 2.get the verification parameters passed from the front end after verification
        $lot_number = $value['lot_number'];
        $captcha_output = $value['captcha_output'];
        $pass_token = $value['pass_token'];
        $gen_time = $value['gen_time'];

        // 3.generate signature
        // use standard hmac algorithms to generate signatures, and take the user's current verification serial number lot_number as the original message, and the client's verification private key as the key
        // use sha256 hash algorithm to hash message and key in one direction to generate the final signature
        $sign_token = hash_hmac('sha256', $lot_number, $captcha_key);

        // 4.upload verification parameters to the secondary verification interface of GeeTest to validate the user verification status
        // geetest recommends to put captcha_id parameter after url, so that when a request exception occurs, it can be quickly located in the log according to the id
        $query = [
            'lot_number' => $lot_number,
            'captcha_output' => $captcha_output,
            'pass_token' => $pass_token,
            'gen_time' => $gen_time,
            'sign_token' => $sign_token,
        ];
        $url = sprintf($api_server.'/validate'.'?captcha_id=%s', $captcha_id);
        $res = $this->post_request($url, $query);
        $obj = json_decode($res, true);
        $this->validatedData = $obj;

        if ($obj['result'] != 'success') {
            return false;
        }

        return true;
    }

    private function post_request($url, $postdata)
    {
        $data = http_build_query($postdata);

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data,
                'timeout' => 5,
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        preg_match('/([0-9])\d+/', $http_response_header[0], $matches);
        $responsecode = intval($matches[0]);
        if ($responsecode != 200) {
            $result = [
                'result' => 'success',
                'reason' => 'request geetest api fail',
            ];

            return $result;
        } else {
            return $result;
        }
    }

    public function getValidatedData()
    {
        return $this->validatedData;
    }
}
