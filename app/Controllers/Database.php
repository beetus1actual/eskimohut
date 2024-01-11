<?php

namespace App\Controllers;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\DatabaseManager;

class Database
{
    private $host = 'localhost';
    private $user = 'eskimo';
    private $pass = 'EskimoHut';
    private $dbName = 'eskimohut_db';

    protected $capsule;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!isset($this->capsule)) {
            $this->capsule = new Capsule();
            $this->capsule->addConnection([
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

        if (!$this->capsule) {
            throw new Exception('Cannot connect to database.');
        }

        return $this->capsule;
    }

    public function getManager(): DatabaseManager
    {
        return $this->capsule->getDatabaseManager();
    }
}
