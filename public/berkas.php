<?php
// Validasi parameter
$filename = $_GET['file'] ?? '';

if (empty($filename)) {
    http_response_code(400);
    die('File not specified');
}

// Sanitasi nama file untuk keamanan
$filename = basename($filename);
$filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);

if (empty($filename)) {
    http_response_code(400);
    die('Invalid filename');
}

// Validasi ekstensi file yang diizinkan
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'webp'];
$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if (!in_array($extension, $allowedExtensions)) {
    http_response_code(403);
    die('File type not allowed');
}

// Cari file di berbagai lokasi
$possiblePaths = [
    __DIR__ . '/storage/berkas/' . $filename,
    __DIR__ . '/../storage/app/public/berkas/' . $filename,
    __DIR__ . '/../public/storage/berkas/' . $filename
];

$filePath = null;
foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
        $filePath = $path;
        break;
    }
}

if (!$filePath || !file_exists($filePath)) {
    http_response_code(404);
    die('File not found: ' . htmlspecialchars($filename));
}

// Validasi ukuran file (maksimal 10MB)
if (filesize($filePath) > 10 * 1024 * 1024) {
    http_response_code(413);
    die('File too large');
}

// Set header berdasarkan tipe file
switch ($extension) {
    case 'jpg':
    case 'jpeg':
        header('Content-Type: image/jpeg');
        break;
    case 'png':
        header('Content-Type: image/png');
        break;
    case 'gif':
        header('Content-Type: image/gif');
        break;
    case 'webp':
        header('Content-Type: image/webp');
        break;
    case 'pdf':
        header('Content-Type: application/pdf');
        break;
    case 'doc':
        header('Content-Type: application/msword');
        break;
    case 'docx':
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        break;
    default:
        header('Content-Type: application/octet-stream');
}

// Set header tambahan
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: public, max-age=3600');
header('Content-Disposition: inline; filename="' . $filename . '"');

// Output file
readfile($filePath);
exit;
?>