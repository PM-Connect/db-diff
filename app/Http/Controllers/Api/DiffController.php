<?php

namespace PMConnect\DBDiff\Http\Controllers\Api;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
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

    /**
     * @var Repository
     */
    protected $cache;

    public function __construct(Diff $diff, Repository $cache)
    {
        $this->diff = $diff;
        $this->cache = $cache;
    }

    public function index()
    {
        $diffs = $this->diff->orderBy('id', 'desc')->get();

        foreach ($diffs as $diff) {
            $diff->successful_logs_count = $diff->running ? $diff->successful_logs()->count() : $this->cache->remember("$diff->id-successful-logs-count", 1, function () use ($diff) {
                return $diff->successful_logs()->count();
            });

            $diff->failed_logs_count = $diff->running ? $diff->failed_logs()->count() : $this->cache->remember("$diff->id-failed-logs-count", 1, function () use ($diff) {
                return $diff->failed_logs()->count();
            });

            $diff->total_columns = $diff->running ? $diff->columns()->get()->count() : $this->cache->remember("$diff->id-total-columns", 1, function () use ($diff) {
                return $diff->columns()->get()->count();
            });

            $diff->total_tables = $diff->running ? $diff->tables()->get()->count() : $this->cache->remember("$diff->id-total-tables", 1, function () use ($diff) {
                return $diff->tables()->get()->count();
            });
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
