<?php
// Simple database connection test
echo "<h2>Database Connection Test</h2>";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    echo "✅ MySQL connection successful<br>";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'ppdb_alif'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Database 'ppdb_alif' exists<br>";
        
        // Connect to the specific database
        $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=ppdb_alif', 'root', '');
        echo "✅ Connected to ppdb_alif database<br>";
        
        // Check if tables exist
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "✅ Database has " . count($tables) . " tables<br>";
            echo "Tables: " . implode(', ', $tables) . "<br>";
        } else {
            echo "❌ Database exists but has no tables. Run migrations!<br>";
        }
        
    } else {
        echo "❌ Database 'ppdb_alif' does not exist<br>";
        echo "Creating database...<br>";
        $pdo->exec("CREATE DATABASE ppdb_alif CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "✅ Database 'ppdb_alif' created successfully<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}

echo "<br><strong>Next Steps:</strong><br>";
echo "1. If database doesn't exist, run setup-laragon.bat<br>";
echo "2. If no tables exist, run migrations<br>";
echo "3. Visit <a href='http://localhost/ppdb_alif'>http://localhost/ppdb_alif</a> to test<br>";
?>