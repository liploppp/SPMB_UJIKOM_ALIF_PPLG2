<?php
// Check admin user in database
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=ppdb_alif', 'root', '');
    
    echo "<h2>Checking Admin User</h2>";
    
    // Check all users
    $stmt = $pdo->query("SELECT * FROM penggunas");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>All Users in Database:</h3>";
    if (count($users) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aktif</th><th>Password Hash</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['nama'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['role'] . "</td>";
            echo "<td>" . ($user['aktif'] ? 'Yes' : 'No') . "</td>";
            echo "<td>" . substr($user['password_hash'], 0, 20) . "...</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "❌ No users found in database<br>";
        
        // Insert admin user
        echo "<br>Creating admin user...<br>";
        $stmt = $pdo->prepare("INSERT INTO penggunas (nama, email, no_hp, password_hash, role, aktif) VALUES (?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([
            'Administrator', 
            'admin@smkbaktinusantara.sch.id', 
            '081234567890', 
            password_hash('password', PASSWORD_DEFAULT), 
            'admin', 
            1
        ]);
        
        if ($result) {
            echo "✅ Admin user created successfully!<br>";
        } else {
            echo "❌ Failed to create admin user<br>";
        }
    }
    
    echo "<br><strong>Login Credentials:</strong><br>";
    echo "Email: admin@smkbaktinusantara.sch.id<br>";
    echo "Password: password<br>";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage();
}
?>