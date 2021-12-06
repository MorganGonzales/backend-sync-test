<?php

namespace Tests\Unit\Services;

use App\Services\SyncMessagesFromExternalSource;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class SyncMessagesFromExternalSourceTest extends \Tests\TestCase
{
    /** @test */
    public function it_returns_an_instance_of_SyncMessagesFromExternalSource()
    {
        $service = new SyncMessagesFromExternalSource('sqlite_external');

        $this->assertClassHasAttribute('externalDbConnection', SyncMessagesFromExternalSource::class);
        $this->assertClassHasAttribute('tables', SyncMessagesFromExternalSource::class);
        $this->assertInstanceOf(SyncMessagesFromExternalSource::class, $service);
    }

    /** @test */
    public function it_should_truncate_and_fill_in_table_records_from_external_db_sources()
    {
        $service = new SyncMessagesFromExternalSource('sqlite_external');

        DB::shouldReceive('beginTransaction')->once();

        $queryBuilderMock = $this->mock(Builder::class, function ($mock) {
            $mock->shouldReceive('truncate')->times(3);
        });
        DB::shouldReceive('table')->times(3)->andReturn($queryBuilderMock);

        $connectionMock = $this->mock(ConnectionInterface::class, function ($mock) {
            $mock->shouldReceive('table')->times(3)->andReturn($mock);
            $mock->shouldReceive('orderBy')->with('id')->times(3)->andReturn($mock);
            $mock->shouldReceive('chunk')->times(3)->andReturn($mock);
        });
        DB::shouldReceive('connection')->with('sqlite_external')->times(3)->andReturn($connectionMock);

        DB::shouldReceive('commit')->once();
        DB::shouldReceive('rollback')->never();

        $service->handle();
    }
}
