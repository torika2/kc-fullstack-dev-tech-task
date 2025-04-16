<?php

declare(strict_types=1);

class Category
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT c.id, c.name, c.parent,
                (SELECT COUNT(*) FROM courses WHERE category_id = c.id) +
                (SELECT COUNT(*) FROM courses WHERE category_id IN (
                    WITH RECURSIVE subcategories AS (
                        SELECT id FROM categories WHERE parent = c.id
                        UNION ALL
                        SELECT cat.id FROM categories cat
                        INNER JOIN subcategories sc ON cat.parent = sc.id
                    )
                    SELECT id FROM subcategories
                )) AS total_courses
            FROM categories c
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category ?: null;
    }
}
