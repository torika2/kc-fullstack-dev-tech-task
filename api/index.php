<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/routes/api.php';

use App\Config\Database;
use App\Migration\Migrate;
use App\Seeder\Seeder;

$argv = $_SERVER['argv'] ?? [];
$database = new Database();

if (isset($argv[1])) {
    if($argv[1] === 'migrate'){
        $migrate = new Migrate($database);
        $migrate->run();
    }
    if($argv[1] === 'seed'){
        $seeder = new Seeder($database);
        $seeder->run();
    }
}
