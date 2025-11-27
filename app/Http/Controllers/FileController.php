<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\PendaftarBerkas;

class FileController extends Controller
{
    public function show($filename)
    {
        try {
            // Sanitize filename untuk keamanan
            $filename = basename($filename);
            $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
            
            if (empty($filename)) {
                return response('Invalid filename', 400);
            }
            
            // Validasi ekstensi file yang diizinkan
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'doc', 'docx'];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (!in_array($extension, $allowedExtensions)) {
                return response('File type not allowed', 403);
            }
            
            // Verifikasi file ada di database (untuk keamanan)
            $berkas = PendaftarBerkas::where('nama_file', $filename)->first();
            if (!$berkas) {
                Log::warning('Attempted access to non-registered file: ' . $filename);
                return response('File not registered', 404);
            }
            
            // Cari file di berbagai lokasi yang mungkin
            $possiblePaths = [
                storage_path('app/public/berkas/' . $filename),
                public_path('storage/berkas/' . $filename),
                base_path('public/storage/berkas/' . $filename)
            ];
            
            foreach ($possiblePaths as $path) {
                if (file_exists($path) && is_readable($path)) {
                    // Validasi ukuran file (maksimal 10MB)
                    if (filesize($path) > 10 * 1024 * 1024) {
                        return response('File too large', 413);
                    }
                    
                    $mimeType = $this->getMimeType($path, $filename);
                    
                    // Log akses file untuk audit
                    Log::info('File accessed: ' . $filename . ' by IP: ' . request()->ip());
                    
                    return response()->file($path, [
                        'Content-Type' => $mimeType,
                        'Cache-Control' => 'public, max-age=3600',
                        'Accept-Ranges' => 'bytes',
                        'X-Content-Type-Options' => 'nosniff',
                        'X-Frame-Options' => 'SAMEORIGIN'
                    ]);
                }
            }
            
            // Log file not found untuk debugging
            Log::error('File not found in any location: ' . $filename, [
                'searched_paths' => $possiblePaths,
                'ip' => request()->ip()
            ]);
            
            // Return 404 dengan informasi debug (hanya untuk admin)
            if (request()->has('debug') && session('admin_id')) {
                $debugInfo = "File tidak ditemukan: {$filename}\n\nLokasi yang dicari:\n";
                foreach ($possiblePaths as $path) {
                    $debugInfo .= "- {$path} (" . (file_exists($path) ? 'EXISTS' : 'NOT FOUND') . ")\n";
                }
                $debugInfo .= "\nFile terdaftar di database: " . ($berkas ? 'YES' : 'NO');
                
                return response($debugInfo, 404)
                    ->header('Content-Type', 'text/plain');
            }
            
            return response('File not found', 404);
            
        } catch (\Exception $e) {
            Log::error('Error accessing file: ' . $filename, [
                'error' => $e->getMessage(),
                'ip' => request()->ip()
            ]);
            
            return response('Internal server error', 500);
        }
    }
    
    private function getMimeType($path, $filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        if (isset($mimeTypes[$extension])) {
            return $mimeTypes[$extension];
        }
        
        // Fallback to mime_content_type if available
        if (function_exists('mime_content_type')) {
            $detectedType = mime_content_type($path);
            if ($detectedType) {
                return $detectedType;
            }
        }
        
        return 'application/octet-stream';
    }
    
    public function validateBerkas(Request $request, $id)
    {
        try {
            $berkas = PendaftarBerkas::findOrFail($id);
            
            $berkas->update([
                'valid' => true,
                'catatan' => $request->catatan ?? null
            ]);
            
            Log::info('Berkas validated: ' . $berkas->nama_file . ' by admin: ' . session('admin_id'));
            
            return response()->json([
                'success' => true,
                'message' => 'Berkas berhasil divalidasi'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error validating berkas: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memvalidasi berkas'
            ], 500);
        }
    }
}