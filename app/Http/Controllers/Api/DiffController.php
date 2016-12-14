<?php

namespace PMConnect\DBDiff\Http\Controllers\Api;

use PMConnect\DBDiff\Http\Controllers\Controller;
use PMConnect\DBDiff\Jobs\DiffDatabases;
use PMConnect\DBDiff\Models\Eloquent\Diff;
use Illuminate\Http\Request;

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

    public function index()
    {
        $diffs = $this->diff->get();

        foreach ($diffs as $diff) {
            $diff->successful_logs_count = $diff->successful_logs()->count();
            $diff->failed_logs_count = $diff->failed_logs()->count();
            $diff->total_columns = $diff->columns()->get()->count();
            $diff->total_tables = $diff->tables()->get()->count();
        }

        return $diffs;
    }

    public function run(Request $request)
    {
        $name = $request->get('name');
        $leftDatabase = $request->get('leftDatabase');
        $rightDatabase = $request->get('rightDatabase');

        if (!$leftDatabase || !$rightDatabase) {
            return abort(400);
        }

        $diff = new Diff;
        $diff->name = $name;
        $diff->primary_database_name = $leftDatabase['name'];
        $diff->secondary_database_name = $rightDatabase['name'];
        $diff->running = true;

        $diff->save();

        $diff->successful_logs_count = $diff->successful_logs()->count();
        $diff->failed_logs_count = $diff->failed_logs()->count();
        $diff->total_columns = $diff->columns()->count();
        $diff->total_tables = $diff->tables()->count();

        $this->dispatch(
            new DiffDatabases($diff->id, $leftDatabase, $rightDatabase)
        );

        return $diff;
    }
}
