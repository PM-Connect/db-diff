<?php

namespace App\Jobs;

use App\Models\Eloquent\Diff as DiffModel;
use PMConnect\DBDiff\Utils\Diff;
use App\Diff\Database\Output;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiffDatabases implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The ID of the diff being run.
     *
     * @var int
     */
    protected $diff;

    /**
     * @var array
     */
    protected $database1;

    /**
     * @var array
     */
    protected $database2;

    /**
     * Create a new job instance.
     *
     * @param int $diff
     * @param array $database1
     * @param array $database2
     */
    public function __construct(int $diff, array $database1, array $database2)
    {
        $this->diff = $diff;
        $this->database1 = $database1;
        $this->database2 = $database2;
    }

    /**
     * Execute the job.
     *
     * @param ConnectionFactory $connection
     * @param Output $output
     * @param DiffModel $diffModel
     */
    public function handle(ConnectionFactory $connection, Output $output, DiffModel $diffModel)
    {
        $database1Connection = $connection->make($this->database1, $this->database1['name']);
        $database2Connection = $connection->make($this->database2, $this->database1['name']);

        $output->setDiffId($this->diff);

        $diffRunner = new Diff(
            $output,
            $database1Connection,
            $database2Connection
        );

        $diffRunner->diff();

        $diff = $diffModel->find($this->diff);

        $diff->running = false;

        $diff->save();
    }
}
