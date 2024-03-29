<?php

declare(strict_types=1);

namespace Sql\Connection\Dsn;

use Sql\Connection\DatabaseName;
use Sql\Connection\Dsn;
use Sql\Connection\Host;
use Sql\Connection\Port;

class Postgres implements Dsn
{
    private $host;
    private $databaseName;
    private $port;

    public function __construct(Host $host, Port $port, DatabaseName $databaseName)
    {
        $this->host = $host;
        $this->databaseName = $databaseName;
        $this->port = $port;
    }

    public function value(): string
    {
        return sprintf('pgsql:host=%s%s%s', $this->host->value(), $this->port(), $this->databaseName());
    }

    private function port()
    {
        if (!$this->port->isSpecified()) {
            return '';
        }

        return ';port=' . $this->port->value();
    }

    private function databaseName()
    {
        if (!$this->databaseName->isSpecified()) {
            return '';
        }

        return ';dbname=' . $this->databaseName->value();
    }
}