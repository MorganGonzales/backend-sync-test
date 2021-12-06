<?php

use App\Models\Message;
use Illuminate\Database\Seeder;

class ExternalMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Message::class, 200)->create();
    }
}
