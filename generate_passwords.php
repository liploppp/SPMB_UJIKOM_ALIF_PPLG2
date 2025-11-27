<?php

// Script untuk generate password hash yang benar
$passwords = [
    'admin123',
    'kepsek123', 
    'verifikator123',
    'keuangan123'
];

echo "Password Hash Generator\n";
echo "======================\n\n";

foreach ($passwords as $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "Password: {$password}\n";
    echo "Hash: {$hash}\n\n";
}

// Generate SQL update statements
echo "SQL Update Statements:\n";
echo "======================\n\n";

$emails = [
    'admin@smkbaktinusantara.sch.id' => 'admin123',
    'kepsek@smkbaktinusantara.sch.id' => 'kepsek123',
    'verifikator@smkbaktinusantara.sch.id' => 'verifikator123',
    'keuangan@smkbaktinusantara.sch.id' => 'keuangan123'
];

foreach ($emails as $email => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "UPDATE penggunas SET password_hash = '{$hash}' WHERE email = '{$email}';\n";
}

echo "\n\nCredentials untuk login:\n";
echo "========================\n";
echo "Admin: admin@smkbaktinusantara.sch.id / admin123\n";
echo "Kepala Sekolah: kepsek@smkbaktinusantara.sch.id / kepsek123\n";
echo "Verifikator: verifikator@smkbaktinusantara.sch.id / verifikator123\n";
echo "Keuangan: keuangan@smkbaktinusantara.sch.id / keuangan123\n";