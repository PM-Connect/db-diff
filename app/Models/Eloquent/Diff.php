<?php

namespace PMConnect\DBDiff\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Diff extends Model
{
    protected $table = 'diffs';

    protected $fillable = [
        'name',
        'primary_database_name',
        'secondary_database_name',
        'running'
    ];

    protected $casts = [
        'running' => 'bool'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Eloquent\Builder
     */
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function successful_logs()
    {
        return $this->logs()->where('result', true);
    }

    public function failed_logs()
    {
        return $this->logs()->where('result', false);
    }

    public function columns()
    {
        return $this->logs()->whereNotNull('column')->groupBy('column');
    }

    public function tables()
    {
        return $this->logs()->whereNotNull('table')->groupBy('table');
    }

    /**
     * @return Collection
     */
    public function getTablesAttribute() : Collection
    {
        return $this->logs()->groupBy('table')->get(['table'])->pluck('table');
    }

    /**
     * @return Collection
     */
    public function getColumnsAttribute() : Collection
    {
        return $this->logs()->groupBy('column')->get(['table'])->pluck('column');
    }
}
