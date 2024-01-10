<?php

namespace App\Controllers;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    private $host = 'localhost';
    private $user = 'eskimo';
    private $pass = 'EskimoHut';
    private $dbName = 'eskimohut_db';

    protected $connection;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!isset($this->connection)) {
            $this->connection = new Capsule();
            $this->connection->addConnection([
                'driver' => 'mysql',
                'host' => $this->host,
                'database' => $this->dbName,
                'username' => $this->user,
                'password' => $this->pass,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
            ]);
        }

        if (!$this->connection) {
            throw new Exception('Cannot connect to database.');
        }

        return $this->connection;
    }
}
