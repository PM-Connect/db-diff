<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'diff_id',
        'database',
        'table',
        'column',
        'type',
        'field',
        'message',
        'result',
    ];

    public function diff()
    {
        return $this->belongsTo(Diff::class);
    }
}
