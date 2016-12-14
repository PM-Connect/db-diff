<?php

namespace App\Diff\Database;

use PMConnect\DBDiff\Utils\Contracts\Output as OutputContract;
use App\Models\Eloquent\Log;

class Output implements OutputContract
{
    /**
     * @var Log
     */
    protected $log;

    protected $diffId;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function setDiffId(int $id)
    {
        $this->diffId = $id;
    }

    public function write(string $message = null, array $context = [])
    {
        $log = $this->log->newInstance();

        $log->message = $message;
        $log->diff_id = $context['diff_id'] ?? $this->diffId ?? null;
        $log->database = $context['database'] ?? null;
        $log->setAttribute('table', $context['table'] ?? null);
        $log->column = $context['column'] ?? null;
        $log->type = $context['type'] ?? null;
        $log->field = $context['field'] ?? null;
        $log->result = $context['result'] ?? false;

        $log->save();
    }
}
