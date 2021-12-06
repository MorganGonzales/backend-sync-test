<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncMessagesFromExternalSource
{
    /** @var array */
    private $tables = [
        'sections',
        'topics',
        'messages',
    ];

    /** @var string */
    private $externalDbConnection;

    public function __construct(string $externalDbConnection)
    {
        $this->externalDbConnection = $externalDbConnection;
    }

    public function handle()
    {
        try {
            DB::beginTransaction();

            $this->truncateMessageTables();
            $this->syncMessageTablesFromExternalDb();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
        }
    }

    private function truncateMessageTables()
    {
        foreach (\array_reverse($this->tables) as $table) {
            DB::table($table)->truncate();
        }
    }

    private function syncMessageTablesFromExternalDb()
    {
        foreach ($this->tables as $table) {
            Log::debug("Fetching external items from $table");
            DB::connection($this->externalDbConnection)
                ->table($table)
                ->orderBy('id')
                ->chunk(100, $this->batchInsertToTable($table));
        }
    }

    private function batchInsertToTable($table): \Closure
    {
        return function ($items) use ($table) {
            $values = [];
            foreach ($items as $item) {
                $values[] = \get_object_vars($item);
            }

            Log::debug("Inserting items to $table");
            DB::table($table)->insert($values);
        };
    }
}
