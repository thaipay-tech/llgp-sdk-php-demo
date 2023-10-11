<?php

namespace Llgp\LlgpSdkPhpDemo;

require '../vendor/autoload.php';
require './PayConfig.php';

use Llgp\LlgpSdkPhp\Constants\LLPayConstant;
use Llgp\LlgpSdkPhp\LLPayClient;
use Llgp\LlgpSdkPhp\Request\PayoutAccountQueryRequest;
use Llgp\LlgpSdkPhp\Request\PayoutApplyRequest;
use Llgp\LlgpSdkPhp\Request\PayoutConfirmRequest;
use Llgp\LlgpSdkPhp\Request\PayoutQueryRequest;
use Llgp\LlgpSdkPhp\Request\PayoutTrueMoneyRequest;
use Llgp\LlgpSdkPhp\Response\PayoutAccountQueryResponse;
use Llgp\LlgpSdkPhp\Response\PayoutApplyResponse;
use Llgp\LlgpSdkPhp\Response\PayoutConfirmResponse;
use Llgp\LlgpSdkPhp\Response\PayoutQueryResponse;
use Llgp\LlgpSdkPhp\Response\PayoutTrueMoneyResponse;

class PayoutDemo
{
    private $payoutClient;

    public function __construct()
    {
        $this->payoutClient = new LLPayClient(PayConfig::$productionEnv, PayConfig::$merchantPrivateKey, PayConfig::$lianLianPublicKey);
    }

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

    public function payoutApplyTrueMoney() {
        $time = date('YmdHis', time());
        $payoutRequest = new PayoutTrueMoneyRequest();
        $payoutRequest->merchant_id = PayConfig::$merchantId;
        $payoutRequest->service = LLPayConstant::PAYOUT_TRUE_MONEY_SERVICE;
        $payoutRequest->version = LLPayConstant::SERVICE_VERSION;
        $payoutRequest->merchant_order_id = 'P' . $time;
        $payoutRequest->order_currency = 'THB';
        $payoutRequest->order_amount = '50.18';
        $payoutRequest->order_info = 'test payout true money order';
        $payoutRequest->payee_account = '0830443596';
        $payoutRequest->notify_url = PayConfig::$notifyUrl;
        $payoutRequest->memo = 'memo test';

        $payoutRequestJson = json_encode($payoutRequest);
        file_put_contents(PayConfig::$logFile, "payoutRequest=$payoutRequestJson\n", FILE_APPEND);

        $result = $this->payoutClient->execute($payoutRequest);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

        if ($result['code'] == 200000 && $result['message'] == 'Success') {
            if ($result['sign_verify'] === true) {
                $payoutTrueMoneyResponse = PayoutTrueMoneyResponse::fromMap($result['data']);
                return json_encode($payoutTrueMoneyResponse, JSON_PRETTY_PRINT);
            } else {
                return 'please check the `$lianLianPublicKey` configuration is correct';
            }
        } else {
            return $resultJson;
        }
    }

    public function payoutConfirm($merchantOrderId, $confirmCode) {
        $payoutRequest = new PayoutConfirmRequest();
        $payoutRequest->merchant_id = PayConfig::$merchantId;
        $payoutRequest->service = LLPayConstant::PAYOUT_CONFIRM_SERVICE;
        $payoutRequest->version = LLPayConstant::SERVICE_VERSION;
        $payoutRequest->merchant_order_id = $merchantOrderId;
        $payoutRequest->confirm_code = $confirmCode;
        $payoutRequest->notify_url = PayConfig::$notifyUrl;

        $payoutRequestJson = json_encode($payoutRequest);
        file_put_contents(PayConfig::$logFile, "payoutRequest=$payoutRequestJson\n", FILE_APPEND);

        $result = $this->payoutClient->execute($payoutRequest);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

        if ($result['code'] == 200000 && $result['message'] == 'Success') {
            if ($result['sign_verify'] === true) {
                $payoutConfirmResponse = PayoutConfirmResponse::fromMap($result['data']);
                return json_encode($payoutConfirmResponse, JSON_PRETTY_PRINT);
            } else {
                return 'please check the `$lianLianPublicKey` configuration is correct';
            }
        } else {
            return $resultJson;
        }
    }

    public function payoutOrderQuery($merchantOrderId) {
        $payoutQueryRequest = new PayoutQueryRequest();
        $payoutQueryRequest->merchant_id = PayConfig::$merchantId;
        $payoutQueryRequest->service = LLPayConstant::PAYOUT_QUERY_SERVICE;
        $payoutQueryRequest->version = LLPayConstant::SERVICE_VERSION;
        $payoutQueryRequest->merchant_order_id = $merchantOrderId;

        $payoutQueryRequestJson = json_encode($payoutQueryRequest);
        file_put_contents(PayConfig::$logFile, "payoutQueryRequest=$payoutQueryRequestJson\n", FILE_APPEND);

        $result = $this->payoutClient->execute($payoutQueryRequest);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

        if ($result['code'] == 200000 && $result['message'] == 'Success') {
            if ($result['sign_verify'] === true) {
                $payoutQueryResponse = PayoutQueryResponse::fromMap($result['data']);
                return json_encode($payoutQueryResponse, JSON_PRETTY_PRINT);
            } else {
                return 'please check the `$lianLianPublicKey` configuration is correct';
            }
        } else {
            return $resultJson;
        }
    }

    public function payoutAccountBalanceQuery() {
        $accountQueryRequest = new PayoutAccountQueryRequest();
        $accountQueryRequest->merchant_id = PayConfig::$merchantId;
        $accountQueryRequest->service = LLPayConstant::PAYOUT_ACCOUNT_QUERY_SERVICE;
        $accountQueryRequest->version = LLPayConstant::SERVICE_VERSION;

        $accountQueryRequestJson = json_encode($accountQueryRequest);
        file_put_contents(PayConfig::$logFile, "accountQueryRequest=$accountQueryRequestJson\n", FILE_APPEND);

        $result = $this->payoutClient->execute($accountQueryRequest);

        $resultJson = json_encode($result);
        file_put_contents(PayConfig::$logFile, "result=$resultJson\n", FILE_APPEND);

        if ($result['code'] == 200000 && $result['message'] == 'Success') {
            if ($result['sign_verify'] === true) {
                $accountQueryResponse = PayoutAccountQueryResponse::fromMap($result['data']);
                return json_encode($accountQueryResponse, JSON_PRETTY_PRINT);
            } else {
                return 'please check the `$lianLianPublicKey` configuration is correct';
            }
        } else {
            return $resultJson;
        }
    }
}