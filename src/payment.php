<?php

namespace Llgp\LlgpSdkPhpDemo;

require './PaymentDemo.php';

$demo = new PaymentDemo();
$demo->checkoutPay();

$demo->bankcardPay();
$demo->aliOnlinePay();
$demo->aliOfflinePay();
$demo->weChatPay();
$demo->qrPromptPay();
$demo->mobileBankingPay();
$demo->linePay();
$demo->shopeePay();
$demo->trueMoneyPay();
$demo->counterPay();

$demo->paymentQuery('P20230928033253');