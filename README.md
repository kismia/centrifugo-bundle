# Centrifugo-bundle for Symfony
This is wrapper for [PHP client](https://github.com/oleh-ozimok/php-centrifugo) for [Centrifugo](https://github.com/centrifugal/centrifugo) real-time messaging server.

## Installation

Install the latest version with

```bash
composer require kismia/centrifugo-bundle
```

Register bundle in app\AppKernel.php

```php
    public function registerBundles()
    {
        $bundles = [
            .......
            new \Kismia\CentrifugoBundle\CentrifugoBundle()
        ];
    }
```

Configure centrifugo-bundle. In the config file add the following lines

```yaml
centrifugo:
    apiendpoint: 'http//example.com/api/'
    secret: 'secret api key'
    transport:
        redis:
            host: 'localhost'
            shards: 6
            db: 2
            timeout: 0.3
            port: 6379
        http: []
```

##Basic usage

```php
<?php
    $userId = 1;
    $channel = '#chan_1';
    $messageData = ['message' => 'Hello, world!'];
    
    //instance of Centrifugo client class
    $centrifugo = $this->get('centrifugo.client');
    
    //Send message into channel.
    $response = $centrifugo->publish($channel, $messageData);
            
    //Very similar to publish but allows to send the same data into many channels.
    $response = $centrifugo->broadcast($channels, $messageData);        
            
    //Unsubscribe user from channel.
    $response = $centrifugo->unsubscribe($channel, $userId);
            
    //Disconnect user by user ID.
    $response = $centrifugo->disconnect($userId);
            
    //Get channel presence information (all clients currently subscribed on this channel).
    $response = $centrifugo->presence($channel);
            
    //Get channel history information (list of last messages sent into channel).
    $response = $centrifugo->history($channel);
            
    //Get channels information (list of currently active channels).
    $response = $centrifugo->channels();
            
    //Get stats information about running server nodes.
    $response = $centrifugo->stats();
            
    //Get information about single Centrifugo node.
    $response = $centrifugo->node('http://node1.example.com/api/');    
```


