<?php

declare(strict_types=1);

namespace App\Migration;

use App\config\Database;

class Migrate
{
    private Database $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function run(): void
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            echo "Request Method: " . $requestMethod . "\n";
        } else {
            echo "No web request (likely CLI)\n";
        }

        $migrations = [
            new CreateCategoryTable($this->database),
            new CreateCoursesTable($this->database),
        ];

        foreach ($migrations as $migration) {
            $migration->up();
        }

        echo "✅ Migrations completed.\n";
    }

    public function rollback(): void
    {
        $migrations = [
            new CreateCoursesTable($this->database),
            new CreateCategoryTable($this->database),
        ];

        foreach (array_reverse($migrations) as $migration) {
            $migration->down();
        }

        echo "🔁 Rollback complete.\n";
    }
}
