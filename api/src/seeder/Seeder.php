<?php

declare(strict_types=1);

namespace App\Seeder;

use App\Config\Database;
use PDO;
use PDOException;

class Seeder
{
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function run(): void
    {
        $this->seedCategories();
        $this->seedCourses();
    }

    private function seedCategories(): void
    {
        $json = file_get_contents(getcwd().'/data/categories.json');
        $categories = json_decode($json, true);
        foreach ($categories as $category) {
            try {
                $stmt = $this->pdo->prepare("
                    INSERT INTO categories (id, name, parent)
                    VALUES (:id, :name, :parent)
                ");
                $stmt->execute([
                    'id' => $category['id'],
                    'name' => $category['name'],
                    'parent' => $category['parent'],
                ]);
            } catch (PDOException $e) {
                echo "❌ Error inserting course: " . $category['id'] . ' - ' . $e->getMessage() . "\n";
            }
        }
        echo "✅  Categories seeder completed.\n";
    }

    private function seedCourses(): void
    {
        $json = file_get_contents(getcwd() . '/data/course_list.json');
        $courses = json_decode($json, true);
        foreach ($courses as $course) {
            try {
                $stmt = $this->pdo->prepare("
                    INSERT INTO courses (course_id, title, description, image_preview, category_id)
                    VALUES (:course_id, :title, :description, :image_preview, :category_id)
                ");
                $stmt->execute([
                    'course_id' => $course['course_id'],
                    'title' => $course['title'],
                    'description' => $course['description'],
                    'image_preview' => $course['image_preview'],
                    'category_id' => $course['category_id'],
                ]);
            } catch (PDOException $e) {
                echo "❌ Error inserting course: " . $course['course_id'] . ' - ' . $e->getMessage() . "\n";
            }
        }
        echo "✅  Courses seeder completed.\n";
    }
}
