<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Course.php';

class CourseController
{
    private Course $courseModel;

    public function __construct(PDO $db)
    {
        $this->courseModel = new Course($db);
    }

    public function getAllCourse(): void
    {
        $courses = $this->courseModel->all();
        header('Content-Type: application/json');
        echo json_encode($courses);
    }

    public function filterByCategory(int $categoryId): void
    {
        $courses = $this->courseModel->byCategory($categoryId);
        header('Content-Type: application/json');
        echo json_encode($courses);
    }
}
