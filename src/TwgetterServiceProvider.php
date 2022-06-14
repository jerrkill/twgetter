<?php

/*
 * This file is part of the overtrue/weather.
 *
 * (c) jerrkill <jerrkill123@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jerrkill\Twgetter;

class TwgetterServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'twgetter');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('twgetter.php'),
        ]);

        $this->app->singleton(Twgetter::class, function () {
            return new Twgetter();
        });

        $this->app->alias(Twgetter::class, 'twgetter');
    }

    public function provides()
    {
        return [Twgetter::class, 'twgetter'];
    }
}
