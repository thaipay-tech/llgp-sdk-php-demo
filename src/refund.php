<?php

namespace Llgp\LlgpSdkPhpDemo;

require './RefundDemo.php';

$demo = new RefundDemo();

$result = $demo->refundApply('P20231011033903');
echo 'Refund Apply Response:' . PHP_EOL;
echo $result . PHP_EOL;

//$result = $demo->refundQuery('R20231011033333');
//echo 'Refund Query Response:' . PHP_EOL;
//echo $result . PHP_EOL;