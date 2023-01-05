<?php

namespace App\Services;

use Laravel\Octane\Facades\Octane;
use Laravel\Octane\Swoole\ServerProcessInspector;

class Concurrent
{
    public function __construct(protected ServerProcessInspector $octane)
    {
    }

    public function run(array $callback)
    {
        if ($this->octane->serverIsRunning()) {
            return Octane::concurrently($callback);
        }

        return collect($callback)->map('call_user_func');
    }
}
