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
"require" : {
    "teknasyon/huawei-mobile-service": "1.0"
}
```

Usage
-----

The first step is to define and implement the **Job** to be managed.

```php
<?php

protected function getPublisherService()
{
    if ($this->publisherService == null) {
        $client = new HuaweiClient($this->credentials);
        if ($this->logger != null) {
            $client->setLogger($this->logger);
        }
        if ($this->redis != null) {
            $client->setRedis($this->redis);
        }
        $this->publisherService = new Publisher($client);
    }
    return $this->publisherService;
}


$subcriptionGetRequest = new SubscriptionGetRequest();
$subcriptionGetRequest->setSubscriptionId($subscriptionId);
$subcriptionGetRequest->setPurchaseToken($purchaseToken);

$purchase = $this->getPublisherService()->purchases_subscriptions->get($subcriptionGetRequest);

```