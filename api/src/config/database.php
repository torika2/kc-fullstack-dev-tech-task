<?php
declare(strict_types=1);

namespace App\Config;
use Exception;
use PDO;

class Database
{
    private PDO $connection;
    private string $host;
    private string $port;
    private string $user;
    private string $pass;
    public function __construct()
    {
        $this->host = 'database.cc.localhost';
        $this->user = 'test_user';
        $this->pass = 'test_password';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $dsn = "mysql:host=$this->host;port=8001";
            $this->connection = new PDO($dsn, $this->user, $this->pass, $options);
        }catch (Exception $e){
            $dsn = "mysql:host=$this->host;port=3306";
            $this->connection = new PDO($dsn, $this->user, $this->pass, $options);
        }
        $this->connection->exec("CREATE DATABASE IF NOT EXISTS course_catalog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $this->connection->exec("USE course_catalog");
    }
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
