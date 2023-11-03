# PHP Dev Kit

## Introduce

> 1. lianlian encapsulates the interface (OpenAPI) for interacting with the server in the development kit. Developers do not need to implement the complex logic of interacting with the server by themselves. After directly introducing the SDK jar package into their own projects, they can interact with the lianlian payment server through the example code of OpenAPI.
> 2. The target audience of this document: technical architects, R&D engineers, test engineers, system operation and maintenance engineers and other relevant personnel involved in merchant system integration lianlian payment.
> 3. The creation payment, refund, payment query, refund query, and payment/refund notification interfaces, including cashier mode and API mode, can be called by developers by modifying some parameters.

## Prepare

### PHP development environment

The SDK is suitable for development environments above PHP 7.0.

### Download and Install Composer

* #### Windows platform
Download address (install composer setup.exe in a Windows environment): https://getcomposer.org/download/

* #### Linux platform
Use the following command to install:
```shell
#php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');"
#php composer-setup.php
All settings correct for using Composer
Downloading...
Composer (version 1.6.5) successfully installed to: /root/composer.phar
Use it: php composer.phar
# Move composer.phar so that Composer can make global calls:
# mv composer.phar /usr/local/bin/composer
# Update composer：
# composer self-update
```

* #### Mac platform
Use the following command to install:
```shell
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
$ composer --version
Composer version 1.7.2 2018-08-16 16:57:12
```

### Install SDK
```shell
composer require llgp/llgp-sdk-php
composer dump-autoload
```

## SDK Demo: [llgp-php-sdk-demo-1.0.0.zip](url)

## SDK Sample Code
SDK Integration Description: The SDK has encapsulated the signature verification logic. When using the SDK, the merchant's public key and other content can be passed in directly through the SDK for automatic signature verification. Signature Method: Please refer to the details of signature verification https://doc.lianlianpay.co.th/#/getting-started/message-specification-and-Signature

### Modify parameter configuration

PayConfig.php
```injectablephp
// Set the production environment to true and the sandbox environment to false
public static $productionEnv = false;
public static $merchantId = '142020042900140006';
public static $storeId = '142020042900140021';
public static $lianLianPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqNUu2yztsr4czTFC1nnGnngy2fdOyON0dAucYqcuXXb8t1u25DXVXaTE1A9Wl7GS+fu5tG2qMfMoWF+4mvtS6VTpQAnxCSkc/vtmtkfD828LYozC4bsZjkrnr+zwoby8AuoTiyYJeDndNsVR2i6dp6jKn2B6L0jDyiV3iWijBhwKLCWUgDht2Ap6dc97hkA+tvoDu/j1MCcIuENtMpBKAuYL6bI/AcfOv2PFmvGeeEilxjiEgC1jZrSlfTs/IhxNZ47IMVKRn7ONzL8CZMAo4yeBQr56MZ0YlmM4EafRTspgh0iNLk+q7SEd4V8co9q+vUea7/eevSl/pd+rKEQzZwIDAQAB';
public static $merchantPrivateKey = 'MIICXQIBAAKBgQC96F1i1FBMLHFom6Ji6q9kUf8PHdMnotdRBSY84ASUa0oMAk5yqUEx98KYTNOr2xFDqbl2pZ6KONA0Ov/fVgiB2bE3TuyKEQ05vVMvv6qnNBSwOXrwL1B1h5Ie3hGQorq2isGgvLxN+vPkZCHrBb2cwghtvLOaTb7/jpipx418GQIDAQABAoGACvfFlPSgIpYagqkiasYVFR0rNutJC6v69YHvoGpruUqs/x6O+05NJp6hjXw6aV2AlMDTpkeQbXk0hR+3MWXdndCjRSFFLpHiKOocqqoguvxpS6AhcnOIEIyHmmxq8kmVNEDtQqWeebfXq9IIKO2LCMkFUn7MKfxurwMFZ4zop5ECQQD0YiTGgiisrgNp1Pi0r1zwjnYHjGGaZylwd33fIF89jQkbGkkQcjGeThPg4hlAnO3Qiuk1sW0EoCrcs+An3ZJ1AkEAxu9Q/c88Us4UjsUcrdIo+kGTLKbBpdpYKCNKFTygWWBqQ+0rySlaOg9H6MV4PagRNr3fJpVdvWh0rC8l23aGlQJBAIjMv6VXiwlOx55gl3AdkjsepDeJf8F86heI7C8Q4f+EiYpgZnIMWnYxYrNKHbSro/xPJkjmLw6d0iCFmH74a1kCQQCKoR8JoC7jbWT6EPZpUvjnXGcZSKPN1hh08BKiNftwDTZAW7iVmFGeACQWW/Xs0YAda7dkBdarNW2Ix9pT04b5AkBxONeuoQOXEbVubfbJPyJ1dO31Rnw+W+Th0wdRguWUeqUWxoTrUWfALWVvdAO8u+F/tS1N7jVn80Lx+H9zYisz';
public static $redirectUrl = 'https://www.yezhou.cc/callback/redirect.php';
public static $notifyUrl = 'https://www.yezhou.cc/callback/notify.php';
```

### Payment Sample Code

PaymentDemo.php
```injectablephp
$payClient = new LLPayClient(PayConfig::$productionEnv, PayConfig::$merchantPrivateKey, PayConfig::$lianLianPublicKey);

public function checkoutPay() {
    $time = date('YmdHis', time());
    $payRequest = new CheckoutPayRequest();
    $payRequest->merchant_id = PayConfig::$merchantId;
    $payRequest->service = LLPayConstant::CHECKOUT_PAY_SERVICE;
    $payRequest->version = LLPayConstant::SERVICE_VERSION;
    $payRequest->merchant_order_id = 'P' . $time;
    $payRequest->order_currency = 'THB';
    $payRequest->order_amount = '50.18';
    $payRequest->order_desc = 'test checkout order';
    $payRequest->notify_url = PayConfig::$notifyUrl;
    $payRequest->redirect_url = PayConfig::$redirectUrl;
    $customer = new Customer();
    $customer->full_name = 'Joe.Ye';
    $customer->merchant_user_id = '10086';
    $payRequest->customer = $customer;

    $payRequestJson = json_encode($payRequest);
    file_put_contents(PayConfig::$logFile, "checkoutPayRequest=$payRequestJson\n", FILE_APPEND);

    $result = $this->payClient->execute($payRequest);

    $resultJson = json_encode($result);
    file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

    if ($result['code'] == 200000 && $result['message'] == 'Success') {
        if ($result['sign_verify'] === true) {
            $checkoutPayResponse = CheckoutPayResponse::fromMap($result['data']);
            return json_encode($checkoutPayResponse, JSON_PRETTY_PRINT);
        } else {
            return 'please check the `$lianLianPublicKey` configuration is correct';
        }
    } else {
        return $resultJson;
    }
}
```

### Refund Sample Code

RefundDemo.php
```injectablephp
$refundClient = new LLPayClient(PayConfig::$productionEnv, PayConfig::$merchantPrivateKey, PayConfig::$lianLianPublicKey);

public function refundApply($merchantOrderId) {
    $time = date('YmdHis', time());
    $refundRequest = new RefundApplyRequest();
    $refundRequest->merchant_id = PayConfig::$merchantId;
    $refundRequest->service = LLPayConstant::REFUND_APPLY_SERVICE;
    $refundRequest->version = LLPayConstant::SERVICE_VERSION;
    $refundRequest->merchant_refund_id = 'R' . $time;
    $refundRequest->merchant_order_id = $merchantOrderId;
    $refundRequest->refund_currency = 'THB';
    $refundRequest->refund_amount = '50.18';
    $refundRequest->refund_reason = 'refund reason';
    $refundRequest->notify_url = PayConfig::$notifyUrl;

    $refundRequestJson = json_encode($refundRequest);
    file_put_contents(PayConfig::$logFile, "refundRequest=$refundRequestJson\n", FILE_APPEND);

    $result = $this->refundClient->execute($refundRequest);

    $resultJson = json_encode($result);
    file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

    if ($result['code'] == 200000 && $result['message'] == 'Success') {
        if ($result['sign_verify'] === true) {
            $refundResponse = RefundApplyResponse::fromMap($result['data']);
            return json_encode($refundResponse, JSON_PRETTY_PRINT);
        } else {
            return 'please check the `$lianLianPublicKey` configuration is correct';
        }
    } else {
        return $resultJson;
    }
}
```

### Payout Sample Code

PayoutDemo.php
```injectablephp
$payoutClient = new LLPayClient(PayConfig::$productionEnv, PayConfig::$merchantPrivateKey, PayConfig::$lianLianPublicKey);

public function payoutApply() {
    $time = date('YmdHis', time());
    $payoutRequest = new PayoutApplyRequest();
    $payoutRequest->merchant_id = PayConfig::$merchantId;
    $payoutRequest->service = LLPayConstant::PAYOUT_APPLY_SERVICE;
    $payoutRequest->version = LLPayConstant::SERVICE_VERSION;
    $payoutRequest->merchant_order_id = 'P' . $time;
    $payoutRequest->order_currency = 'THB';
    $payoutRequest->order_amount = '50.18';
    $payoutRequest->order_info = 'test payout order';
    $payoutRequest->payee_bankcard_account = '1113939657';
    $payoutRequest->payee_bankcard_account_name = 'account name';
    $payoutRequest->payee_bank_code = '014';
    $payoutRequest->notify_url = PayConfig::$notifyUrl;
    $payoutRequest->memo = 'memo test';

    $payoutRequestJson = json_encode($payoutRequest);
    file_put_contents(PayConfig::$logFile, "payoutRequest=$payoutRequestJson\n", FILE_APPEND);

    $result = $this->payoutClient->execute($payoutRequest);

    $resultJson = json_encode($result);
    file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

    if ($result['code'] == 200000 && $result['message'] == 'Success') {
        if ($result['sign_verify'] === true) {
            $payoutResponse = PayoutApplyResponse::fromMap($result['data']);
            return json_encode($payoutResponse, JSON_PRETTY_PRINT);
        } else {
            return 'please check the `$lianLianPublicKey` configuration is correct';
        }
    } else {
        return $resultJson;
    }
}
```