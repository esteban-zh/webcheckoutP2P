<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class P2PService {

    protected $endpointBase;
    public $login;
    protected $secretKey;

    public function __construct()
    {
        $this->endpointBase = config('services.placetopay.endpoint_base');
        $this->login = config('services.placetopay.login');
        $this->secretKey = config('services.placetopay.secret_key');
    }

    public function createRequest($payment){
         $response = Http::post($this->endpointBase . '/api/session/', [
            'auth' => $this->getAuthenticationData(),
            'payment' => [
                 'reference' => $payment->id,
                 'description' => $payment->description,
                 'amount' => [
                     'currency' => 'COP',
                     'total' => $payment->amount,
                ],
            ],
            'expiration' =>date('c', strtotime('1 hour')),
            'returnUrl' => 'http://127.0.0.1:8000/',
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'PlacetoPay Sandbox',

        ]);
        $payment->reference = $response['requestId'];
        $payment->process_url = $response['processUrl'];
        $payment->save();
        return $response->json();
    }

    public function getAuthenticationData()
    {
        $login = $this->login;
        $secretKey = $this->secretKey;
        $seed = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        return [
            'login' => $login,
            'seed' => $seed,
            'nonce' => $nonceBase64,
            'tranKey' => $tranKey
        ];
    }

    public function getRequestInformation($requestId)
    {
        $response = Http::post('https://test.placetopay.com/redirection/api/session/' . $requestId, [
            'auth' => $this->getAuthenticationData(),
        ]);

        return $response->json();
    }
}