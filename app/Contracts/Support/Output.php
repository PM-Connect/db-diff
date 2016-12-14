<?php

namespace PMConnect\DBDiff\Contracts\Support;

interface Output
{
    public function write(string $message = null, array $context = []);
}
