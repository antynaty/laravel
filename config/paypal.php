<?php
return [
  'client_id' => env('PAYPAL_CLIENT_ID'),
  'secret' => env('PAYPAL_SECRET'),
  'settings' =>[
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'http.ConnectionTimeOut' => 300,
    'log.LogEnable' => true,
    'log.FileName' => storage_path('/logs/paypal.log'),
    'log.LogLevel' => 'ERROR',
  ]
];