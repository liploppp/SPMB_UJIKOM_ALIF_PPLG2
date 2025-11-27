<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pendaftaran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { margin: 10px 0; }
        .content { margin: 20px 0; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { padding: 8px; border-bottom: 1px solid #ddd; }
        .footer { margin-top: 40px; text-align: right; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>

    <div class="header">
        <h2>SMK BAKTI NUSANTARA 666</h2>
        <p>Jl. Contoh No. 123, Bandung, Jawa Barat</p>
        <hr>
        <h3>BUKTI PENDAFTARAN SISWA BARU</h3>
    </div>

    <div class="content">
        <table class="table">
            <tr>
                <td width="30%"><strong>Nama Lengkap</strong></td>
                <td>: {{ $pendaftar->siswa_nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>NISN</strong></td>
                <td>: {{ $pendaftar->siswa_nisn ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>NIK</strong></td>
                <td>: {{ $pendaftar->siswa_nik ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tempat, Tanggal Lahir</strong></td>
                <td>: {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tanggal_lahir ? date('d/m/Y', strtotime($pendaftar->tanggal_lahir)) : '-' }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td>: {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>: {{ $pendaftar->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Asal Sekolah</strong></td>
                <td>: {{ $pendaftar->asal_sekolah ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Jurusan Pilihan</strong></td>
                <td>: {{ $pendaftar->jurusan_nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Gelombang</strong></td>
                <td>: {{ $pendaftar->gelombang_nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>No. Pendaftaran</strong></td>
                <td>: {{ $pendaftar->no_pendaftaran ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Pendaftaran</strong></td>
                <td>: {{ date('d F Y, H:i', strtotime($pendaftar->created_at)) }} WIB</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>: 
                    @if($pendaftar->status == 'SUBMIT')
                        Menunggu Verifikasi
                    @elseif($pendaftar->status == 'VERIFIKASI')
                        Sedang Diverifikasi
                    @elseif($pendaftar->status == 'DITERIMA')
                        DITERIMA
                    @elseif($pendaftar->status == 'DITOLAK')
                        DITOLAK
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Bandung, {{ date('d F Y') }}</p>
        <br><br><br>
        <p>Panitia Penerimaan Siswa Baru<br>SMK Bakti Nusantara 666</p>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>