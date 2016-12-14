<?php

namespace App\Contracts\Support;

interface Output
{
    public function write(string $message = null, array $context = []);
}
