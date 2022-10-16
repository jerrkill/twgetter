<?php

/*
 * This file is part of the jerrkill/twgetter.
 *
 * (c) jerrkill <jerrkill123@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    'x_csrf_token' => function_exists('env') ? env('TWGETTER_X_CSRF_TOKEN', '') : '',
    'cookie'       => function_exists('env') ? env('TWGETTER_COOKIE', '') : $cookie,
    'bearer_token' => function_exists('env') ? env('TWGETTER_BEARER_TOKEN', '') : '',
];
