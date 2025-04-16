<?php
declare(strict_types=1);

use App\Config\Database;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../controllers/CourseController.php';
require_once __DIR__ . '/../controllers/CategoryController.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$database = new Database();
$db = $database->getConnection();

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

//Controllers
$courseController = new CourseController($db);
$categoryController = new CategoryController($db);

if ($method === 'GET') {
    if ($requestUri === '/api/courses') {
        $courseController->getAllCourse();
    } elseif (preg_match('#^/api/courses/category/(\d+)$#', $requestUri, $matches)) {
        $courseController->filterByCategory((int)$matches[1]);
    }
    if ($requestUri === '/api/categories') {
        $categoryController->getAllCategory();
    } elseif (preg_match('#^/api/categories/(\d+)$#', $requestUri, $matches)) {
        $categoryController->filterByCategoryId((int)$matches[1]);
    }
}