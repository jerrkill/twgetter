<?php

return [
    'x_csrf_token' => function_exists('env') ? env('TWGETTER_X_CSRF_TOKEN', '') : '',
    'cookie' => function_exists('env') ? env('TWGETTER_COOKIE', '') : $cookie,
    'bearer_token' => function_exists('env') ? env('TWGETTER_BEARER_TOKEN', '') : '',
];