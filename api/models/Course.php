<?php

declare(strict_types=1);

class Course
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT courses.*, categories.name AS main_category 
            FROM courses 
            JOIN categories ON courses.category_id = categories.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function byCategory(int $categoryId): array
    {
        $stmt = $this->db->prepare("
            WITH RECURSIVE subcategories AS (
                SELECT id FROM categories WHERE id = ?
                UNION ALL
                SELECT c.id FROM categories c
                INNER JOIN subcategories sc ON c.parent = sc.id
            )
            SELECT courses.*, categories.name AS main_category
            FROM courses
            JOIN categories ON courses.category_id = categories.id
            WHERE courses.category_id IN (SELECT id FROM subcategories)
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
