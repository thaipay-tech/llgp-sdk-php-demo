<?php

namespace Llgp\LlgpSdkPhpDemo;

class PayConfig
{
    public static $productionEnv = false;
    public static $merchantId = '142020042900140006';
    public static $storeId = '142020042900140021';
    public static $lianLianPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqNUu2yztsr4czTFC1nnGnngy2fdOyON0dAucYqcuXXb8t1u25DXVXaTE1A9Wl7GS+fu5tG2qMfMoWF+4mvtS6VTpQAnxCSkc/vtmtkfD828LYozC4bsZjkrnr+zwoby8AuoTiyYJeDndNsVR2i6dp6jKn2B6L0jDyiV3iWijBhwKLCWUgDht2Ap6dc97hkA+tvoDu/j1MCcIuENtMpBKAuYL6bI/AcfOv2PFmvGeeEilxjiEgC1jZrSlfTs/IhxNZ47IMVKRn7ONzL8CZMAo4yeBQr56MZ0YlmM4EafRTspgh0iNLk+q7SEd4V8co9q+vUea7/eevSl/pd+rKEQzZwIDAQAB';
    public static $merchantPrivateKey = 'MIICXQIBAAKBgQC96F1i1FBMLHFom6Ji6q9kUf8PHdMnotdRBSY84ASUa0oMAk5yqUEx98KYTNOr2xFDqbl2pZ6KONA0Ov/fVgiB2bE3TuyKEQ05vVMvv6qnNBSwOXrwL1B1h5Ie3hGQorq2isGgvLxN+vPkZCHrBb2cwghtvLOaTb7/jpipx418GQIDAQABAoGACvfFlPSgIpYagqkiasYVFR0rNutJC6v69YHvoGpruUqs/x6O+05NJp6hjXw6aV2AlMDTpkeQbXk0hR+3MWXdndCjRSFFLpHiKOocqqoguvxpS6AhcnOIEIyHmmxq8kmVNEDtQqWeebfXq9IIKO2LCMkFUn7MKfxurwMFZ4zop5ECQQD0YiTGgiisrgNp1Pi0r1zwjnYHjGGaZylwd33fIF89jQkbGkkQcjGeThPg4hlAnO3Qiuk1sW0EoCrcs+An3ZJ1AkEAxu9Q/c88Us4UjsUcrdIo+kGTLKbBpdpYKCNKFTygWWBqQ+0rySlaOg9H6MV4PagRNr3fJpVdvWh0rC8l23aGlQJBAIjMv6VXiwlOx55gl3AdkjsepDeJf8F86heI7C8Q4f+EiYpgZnIMWnYxYrNKHbSro/xPJkjmLw6d0iCFmH74a1kCQQCKoR8JoC7jbWT6EPZpUvjnXGcZSKPN1hh08BKiNftwDTZAW7iVmFGeACQWW/Xs0YAda7dkBdarNW2Ix9pT04b5AkBxONeuoQOXEbVubfbJPyJ1dO31Rnw+W+Th0wdRguWUeqUWxoTrUWfALWVvdAO8u+F/tS1N7jVn80Lx+H9zYisz';
    public static $redirectUrl = 'https://www.yezhou.cc/callback/redirect.php';
    public static $notifyUrl = 'https://www.yezhou.cc/callback/notify.php';

    public static $logFile = 'log.txt';
}