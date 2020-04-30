Huawei Mobile Service
======================================

Current services:

   - **InAppPurchase** 


Requirements
------------
```
ext-json
ext-redis
google/apiclient
guzzlehttp/guzzle
```

Install
-------

```
"repositories": [
    {
      "type": "git",
      "url": "https://github.com/Teknasyon-Teknoloji/huawei-mobile-service.git"
    }
],
"require" : {
    "teknasyon/huawei-mobile-service": "dev-master",
}
```

Usage
-----

The first step is to define and implement the **Job** to be managed.

```php
<?php

$client = new HuaweiClient($this->credentials);
if ($logger != null) {
    $client->setLogger($logger);
}
if ($redis != null) {
    $client->setRedis($redis);
}
$publisherService = new Publisher($client);


$subcriptionGetRequest = new SubscriptionGetRequest();
$subcriptionGetRequest->setSubscriptionId($subscriptionId);
$subcriptionGetRequest->setPurchaseToken($purchaseToken);

$purchase = $publisherService->purchases_subscriptions->get($subcriptionGetRequest);

```