<?php
declare(strict_types=1);

namespace App\Migration;

use App\config\Database;
use PDO;

class CreateCategoryTable
{
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function up(): void
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS categories (
            id VARCHAR(255) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            parent VARCHAR(255),
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        try {
            $this->pdo->exec($sql);
            echo "Categories table created successfully.\n";
        } catch (\PDOException $e) {
            echo "Error creating table: " . $e->getMessage() . "\n";
        }
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS categories";

        try {
            $this->pdo->exec($sql);
            echo "Categories table dropped successfully.\n";
        } catch (\PDOException $e) {
            echo "Error dropping table: " . $e->getMessage() . "\n";
        }
    }
}
