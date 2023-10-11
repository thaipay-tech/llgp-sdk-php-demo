<?php

namespace Llgp\LlgpSdkPhpDemo;

require './PaymentDemo.php';

$demo = new PaymentDemo();

$result = $demo->checkoutPay();
print 'Checkout Pay Response:' . PHP_EOL;
print $result . PHP_EOL;

//$result = $demo->bankcardPay();
//echo 'Bankcard Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
////
//$result = $demo->aliOnlinePay();
//echo 'Ali-Online Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->aliOfflinePay();
//echo 'Ali-Offline Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->weChatPay();
//echo 'Wechat Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->qrPromptPay();
//echo 'QR Prompt Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->mobileBankingPay();
//echo 'Mobile Banking Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->linePay();
//echo 'Line Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->shopeePay();
//echo 'Shopee Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->trueMoneyPay();
//echo 'True Money Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->counterPay();
//echo 'Counter Pay Response:' . PHP_EOL;
//echo $result . PHP_EOL;
//
//$result = $demo->paymentQuery('P20231011032747');
//echo 'Payment Query Response:' . PHP_EOL;
//echo $result . PHP_EOL;