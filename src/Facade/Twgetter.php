<?php

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
