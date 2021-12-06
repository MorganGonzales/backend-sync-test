<?php

namespace App\Console\Commands;

use App\Services\SyncMessagesFromExternalSource;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncMessagesFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:sync-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync messages from external API source';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new SyncMessagesFromExternalSource('sqlite_external'))->handle();
    }
}
