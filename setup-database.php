<?php
// Manual database setup script
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'ppdb_alif',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Test connection
    $capsule->connection()->getPdo();
    echo "✅ Database connection successful!\n";
    
    // Check if tables exist
    $tables = $capsule->select('SHOW TABLES');
    echo "📋 Current tables:\n";
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "  - $tableName\n";
    }
    
    // Check if key tables exist
    $requiredTables = ['sessions', 'penggunas', 'otp_verifications', 'gelombangs', 'jurusans'];
    $existingTables = array_map(function($table) {
        return array_values((array)$table)[0];
    }, $tables);
    
    $missingTables = array_diff($requiredTables, $existingTables);
    
    if (empty($missingTables)) {
        echo "✅ All required tables exist!\n";
    } else {
        echo "❌ Missing tables: " . implode(', ', $missingTables) . "\n";
        echo "💡 Please run: php artisan migrate:fresh --seed\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    
    // Try to create database
    try {
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
        ], 'create_db');
        
        $capsule->connection('create_db')->statement('CREATE DATABASE IF NOT EXISTS ppdb_alif');
        echo "✅ Database 'ppdb_alif' created!\n";
        echo "💡 Now run: php artisan migrate:fresh --seed\n";
        
    } catch (Exception $e2) {
        echo "❌ Failed to create database: " . $e2->getMessage() . "\n";
    }
}
?>