<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Category.php';

class CategoryController
{
    private Category $categoryModel;

    public function __construct(PDO $db)
    {
        $this->categoryModel = new Category($db);
    }

    public function getAllCategory(): void
    {
        $categories = $this->categoryModel->all();
        header('Content-Type: application/json');
        echo json_encode($categories);
    }

    public function filterByCategoryId(int $id): void
    {
        $category = $this->categoryModel->get($id);
        if ($category) {
            header('Content-Type: application/json');
            echo json_encode($category);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Category not found']);
        }
    }
}
