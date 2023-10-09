<?php

namespace Llgp\LlgpSdkPhpDemo;

require '../vendor/autoload.php';
require './PayConfig.php';

use Llgp\LlgpSdkPhp\Constants\LLPayConstant;
use Llgp\LlgpSdkPhp\LLPayClient;
use Llgp\LlgpSdkPhp\Model\Card;
use Llgp\LlgpSdkPhp\Model\Customer;
use Llgp\LlgpSdkPhp\Request\AliOfflinePayRequest;
use Llgp\LlgpSdkPhp\Request\AliOnlinePayRequest;
use Llgp\LlgpSdkPhp\Request\BankcardPayRequest;
use Llgp\LlgpSdkPhp\Request\CheckoutPayRequest;
use Llgp\LlgpSdkPhp\Request\CounterPayRequest;
use Llgp\LlgpSdkPhp\Request\LinePayRequest;
use Llgp\LlgpSdkPhp\Request\MobileBankingPayRequest;
use Llgp\LlgpSdkPhp\Request\PaymentQueryRequest;
use Llgp\LlgpSdkPhp\Request\QRPromptPayRequest;
use Llgp\LlgpSdkPhp\Request\ShopeePayRequest;
use Llgp\LlgpSdkPhp\Request\TrueMoneyPayRequest;
use Llgp\LlgpSdkPhp\Request\WeChatPayRequest;
use Llgp\LlgpSdkPhp\Response\AliOfflinePayResponse;
use Llgp\LlgpSdkPhp\Response\AliOnlinePayResponse;
use Llgp\LlgpSdkPhp\Response\BankcardPayResponse;
use Llgp\LlgpSdkPhp\Response\CheckoutPayResponse;
use Llgp\LlgpSdkPhp\Response\CounterPayResponse;
use Llgp\LlgpSdkPhp\Response\LinePayResponse;
use Llgp\LlgpSdkPhp\Response\MobileBankingPayResponse;
use Llgp\LlgpSdkPhp\Response\PaymentQueryResponse;
use Llgp\LlgpSdkPhp\Response\QRPromptPayResponse;
use Llgp\LlgpSdkPhp\Response\ShopeePayResponse;
use Llgp\LlgpSdkPhp\Response\TrueMoneyPayResponse;
use Llgp\LlgpSdkPhp\Response\WeChatPayResponse;

class PaymentDemo
{
    private $payClient;

    public function __construct()
    {
        $this->payClient = new LLPayClient(PayConfig::$productionEnv, PayConfig::$merchantPrivateKey, PayConfig::$lianLianPublicKey);
    }

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

        $checkoutPayResponse = CheckoutPayResponse::fromMap($result['data']);
        echo json_encode($checkoutPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function bankcardPay() {
        $time = date('YmdHis', time());
        $payRequest = new BankcardPayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::BANKCARD_PAY_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::CARD;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $card = new Card();
        $card->holder_name = 'Joe.Ye';
        $card->card_no = '10086';
        $card->card_type = '10086';
        $card->exp_year = '10086';
        $card->exp_month = '10086';
        $card->cvv2 = '10086';
        $payRequest->card = $card;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "bankcardPayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $bankcardPayResponse = BankcardPayResponse::fromMap($result['data']);
        echo json_encode($bankcardPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function aliOnlinePay() {
        $time = date('YmdHis', time());
        $payRequest = new AliOnlinePayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::ALIPAY_ONLINE_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_info = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::WEB_PAYMENT;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "aliOnlinePayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $aliOnlinePayResponse = AliOnlinePayResponse::fromMap($result['data']);
        echo json_encode($aliOnlinePayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function aliOfflinePay() {
        $time = date('YmdHis', time());
        $payRequest = new AliOfflinePayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->store_id = PayConfig::$storeId;
        $payRequest->service = LLPayConstant::ALIPAY_OFFLINE_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_info = 'test checkout order';
        $payRequest->payment_type = LLPayConstant::DYNAMIC_CODE;
        $payRequest->notify_url = PayConfig::$notifyUrl;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "aliOfflinePayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $aliOfflinePayResponse = AliOfflinePayResponse::fromMap($result['data']);
        echo json_encode($aliOfflinePayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function weChatPay() {
        $time = date('YmdHis', time());
        $payRequest = new WeChatPayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::WECHAT_PAY_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_info = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::DYNAMIC_CODE;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "weChatPayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $weChatPayResponse = WeChatPayResponse::fromMap($result['data']);
        echo json_encode($weChatPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function qrPromptPay() {
        $time = date('YmdHis', time());
        $payRequest = new QRPromptPayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::QR_PROMPT_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::THAI_QR;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "qrPromptPayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $qrPromptPayResponse = QRPromptPayResponse::fromMap($result['data']);
        echo json_encode($qrPromptPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function mobileBankingPay() {
        $time = date('YmdHis', time());
        $payRequest = new MobileBankingPayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::MOBILE_BANKING_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::EASY_APP_BILL;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->app_callback_url = 'app_callback_url';
        $payRequest->mobile_number = '0899898820';

        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "mobileBankingPayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $mobileBankingPayResponse = MobileBankingPayResponse::fromMap($result['data']);
        echo json_encode($mobileBankingPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function linePay() {
        $time = date('YmdHis', time());
        $payRequest = new LinePayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::LINE_PAY_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::NORMAL_BALANCE;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "linePayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $linePayResponse = LinePayResponse::fromMap($result['data']);
        echo json_encode($linePayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function shopeePay() {
        $time = date('YmdHis', time());
        $payRequest = new ShopeePayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::SHOPEE_PAY_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::NORMAL_BALANCE_SP;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "shopeePayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $shopeePayResponse = ShopeePayResponse::fromMap($result['data']);
        echo json_encode($shopeePayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function trueMoneyPay() {
        $time = date('YmdHis', time());
        $payRequest = new TrueMoneyPayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::TRUE_MONEY_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::NORMAL_ALL_TM;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "trueMoneyPayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $trueMoneyPayResponse = TrueMoneyPayResponse::fromMap($result['data']);
        echo json_encode($trueMoneyPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function counterPay() {
        $time = date('YmdHis', time());
        $payRequest = new CounterPayRequest();
        $payRequest->merchant_id = PayConfig::$merchantId;
        $payRequest->service = LLPayConstant::COUNTER_PAY_SERVICE;
        $payRequest->version = LLPayConstant::SERVICE_VERSION;
        $payRequest->merchant_order_id = 'P' . $time;
        $payRequest->order_currency = 'THB';
        $payRequest->order_amount = '50.18';
        $payRequest->order_desc = 'test checkout order';
        $payRequest->payment_method = LLPayConstant::COUNTER_UNION;
        $payRequest->notify_url = PayConfig::$notifyUrl;
        $payRequest->redirect_url = PayConfig::$redirectUrl;
        $customer = new Customer();
        $customer->full_name = 'Joe.Ye';
        $customer->merchant_user_id = '10086';
        $payRequest->customer = $customer;

        $payRequestJson = json_encode($payRequest);
        file_put_contents(PayConfig::$logFile, "counterPayRequest=$payRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($payRequest);

        $counterPayResponse = CounterPayResponse::fromMap($result['data']);
        echo json_encode($counterPayResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }

    public function paymentQuery($merchantOrderId) {
        $paymentQueryRequest = new PaymentQueryRequest();
        $paymentQueryRequest->merchant_id = PayConfig::$merchantId;
        $paymentQueryRequest->service = LLPayConstant::PAYMENT_QUERY_SERVICE;
        $paymentQueryRequest->version = LLPayConstant::SERVICE_VERSION;
        $paymentQueryRequest->merchant_order_id = $merchantOrderId;

        $paymentQueryRequestJson = json_encode($paymentQueryRequest);
        file_put_contents(PayConfig::$logFile, "paymentQueryRequest=$paymentQueryRequestJson\n", FILE_APPEND);

        $result = $this->payClient->execute($paymentQueryRequest);

        $paymentQueryResponse = PaymentQueryResponse::fromMap($result['data']);
        echo json_encode($paymentQueryResponse, JSON_PRETTY_PRINT);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);
    }
}