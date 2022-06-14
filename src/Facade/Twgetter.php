<?php

/*
 * This file is part of the overtrue/weather.
 *
 * (c) jerrkill <jerrkill123@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jerrkill\Twgetter\Facades;

use Illuminate\Support\Facades\Facade;

class Twgetter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Jerrkill\Twgetter\Twgetter';
    }
}
