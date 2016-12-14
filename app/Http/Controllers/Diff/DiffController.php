<?php

namespace PMConnect\DBDiff\Http\Controllers\Diff;

use PMConnect\DBDiff\Http\Controllers\Controller;
use PMConnect\DBDiff\Models\Eloquent\Diff;

class DiffController extends Controller
{
    /**
     * @var Diff
     */
    protected $diff;

    public function __construct(Diff $diff)
    {
        $this->diff = $diff;
    }

    public function show(Diff $diff)
    {
        return view('diff', [
            'diff' => $diff,
            'logs' => $diff->logs()->orderBy('result', 'asc')->get(),
            'failures' => $diff->logs()->where('result', false)->count(),
            'successful' =>$diff->logs()->where('result', true)->count(),
        ]);
    }
}
