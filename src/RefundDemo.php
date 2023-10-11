<?php

namespace Llgp\LlgpSdkPhpDemo;

require '../vendor/autoload.php';
require './PayConfig.php';

use Llgp\LlgpSdkPhp\Constants\LLPayConstant;
use Llgp\LlgpSdkPhp\LLPayClient;
use Llgp\LlgpSdkPhp\Request\RefundApplyRequest;
use Llgp\LlgpSdkPhp\Request\RefundQueryRequest;
use Llgp\LlgpSdkPhp\Response\RefundApplyResponse;
use Llgp\LlgpSdkPhp\Response\RefundQueryResponse;

class RefundDemo
{
    private $refundClient;

    public function __construct()
    {
        $this->refundClient = new LLPayClient(PayConfig::$productionEnv, PayConfig::$merchantPrivateKey, PayConfig::$lianLianPublicKey);
    }

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

    public function refundQuery($merchantRefundId) {
        $refundQueryRequest = new RefundQueryRequest();
        $refundQueryRequest->merchant_id = PayConfig::$merchantId;
        $refundQueryRequest->service = LLPayConstant::REFUND_QUERY_SERVICE;
        $refundQueryRequest->version = LLPayConstant::SERVICE_VERSION;
        $refundQueryRequest->merchant_refund_id = $merchantRefundId;

        $refundQueryRequestJson = json_encode($refundQueryRequest);
        file_put_contents(PayConfig::$logFile, "refundQueryRequest=$refundQueryRequestJson\n", FILE_APPEND);

        $result = $this->refundClient->execute($refundQueryRequest);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

        if ($result['code'] == 200000 && $result['message'] == 'Success') {
            if ($result['sign_verify'] === true) {
                $refundQueryResponse = RefundQueryResponse::fromMap($result['data']);
                return json_encode($refundQueryResponse, JSON_PRETTY_PRINT);
            } else {
                return 'please check the `$lianLianPublicKey` configuration is correct';
            }
        } else {
            return $resultJson;
        }
    }
}