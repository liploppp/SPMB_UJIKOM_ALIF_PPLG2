<?php
// Test database connection and login functionality
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h2>Database Connection Test</h2>";

try {
    // Test database connection
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=ppdb_alif', 'root', '');
    echo "✅ Database connection successful<br>";
    
    // Check if penggunas table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'penggunas'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Table 'penggunas' exists<br>";
        
        // Check if admin user exists
        $stmt = $pdo->query("SELECT * FROM penggunas WHERE role = 'admin'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Admin user exists<br>";
        } else {
            echo "❌ No admin user found<br>";
        }
    } else {
        echo "❌ Table 'penggunas' does not exist<br>";
    }
    
    // Check OTP table
    $stmt = $pdo->query("SHOW TABLES LIKE 'otp_verifications'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Table 'otp_verifications' exists<br>";
    } else {
        echo "❌ Table 'otp_verifications' does not exist<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

echo "<br><strong>Next Steps:</strong><br>";
echo "1. Run: <code>run-migrations.bat</code><br>";
echo "2. Test login at: <a href='/login'>/login</a><br>";
echo "3. Test register at: <a href='/register'>/register</a><br>";
?>