<?php
declare(strict_types=1);

namespace App\Migration;

use App\config\Database;
use PDO;

class CreateCoursesTable
{
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function up(): void
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS courses (
            course_id VARCHAR(255) PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            image_preview VARCHAR(255) NOT NULL,
            category_id VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id)
        )";

        try {
            $this->pdo->exec($sql);
            echo "Courses table created successfully.\n";
        } catch (\PDOException $e) {
            echo "Error creating table: " . $e->getMessage() . "\n";
        }
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS courses";

        try {
            $this->pdo->exec($sql);
            echo "Courses table dropped successfully.\n";
        } catch (\PDOException $e) {
            echo "Error dropping table: " . $e->getMessage() . "\n";
        }
    }
}
