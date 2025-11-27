<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran - {{ $pendaftar->no_pendaftaran }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }
        .header p {
            margin: 3px 0;
            font-size: 12px;
            color: #666;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline;
        }
        .info-box {
            border: 2px solid #333;
            padding: 15px;
            margin: 20px 0;
        }
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        .info-label {
            display: table-cell;
            width: 40%;
            font-weight: bold;
        }
        .info-value {
            display: table-cell;
            width: 60%;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .signature {
            margin-top: 60px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMK BAKTI NUSANTARA 666</h1>
        <h2>PENERIMAAN PESERTA DIDIK BARU</h2>
        <p>Jl. Contoh No. 123, Kota Bandung | Telp: (022) 1234567 | Email: info@smkbaktinus.sch.id</p>
    </div>

    <div class="title">BUKTI PENDAFTARAN</div>

    <div class="info-box">
        <div class="info-row">
            <div class="info-label">No. Pendaftaran</div>
            <div class="info-value">: {{ $pendaftar->no_pendaftaran }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Daftar</div>
            <div class="info-value">: {{ \Carbon\Carbon::parse($pendaftar->tanggal_daftar)->format('d F Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Gelombang</div>
            <div class="info-value">: {{ $pendaftar->gelombang_nama ?? '-' }}</div>
        </div>
    </div>

    <h3 style="margin-top: 20px; border-bottom: 2px solid #333; padding-bottom: 5px;">Data Calon Siswa</h3>
    <div class="info-box">
        <div class="info-row">
            <div class="info-label">Nama Lengkap</div>
            <div class="info-value">: {{ $pendaftar->siswa_nama }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">NISN</div>
            <div class="info-value">: {{ $pendaftar->siswa_nisn }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">NIK</div>
            <div class="info-value">: {{ $pendaftar->siswa_nik ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tempat, Tanggal Lahir</div>
            <div class="info-value">: {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tanggal_lahir ? \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') : '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Jenis Kelamin</div>
            <div class="info-value">: {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Asal Sekolah</div>
            <div class="info-value">: {{ $pendaftar->asal_sekolah ?? '-' }}</div>
        </div>
    </div>

    @if(isset($pendaftar->nama_ayah) || isset($pendaftar->nama_ibu))
    <h3 style="margin-top: 20px; border-bottom: 2px solid #333; padding-bottom: 5px;">Data Orang Tua</h3>
    <div class="info-box">
        <div class="info-row">
            <div class="info-label">Nama Ayah</div>
            <div class="info-value">: {{ $pendaftar->nama_ayah ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Pekerjaan Ayah</div>
            <div class="info-value">: {{ $pendaftar->pekerjaan_ayah ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Nama Ibu</div>
            <div class="info-value">: {{ $pendaftar->nama_ibu ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Pekerjaan Ibu</div>
            <div class="info-value">: {{ $pendaftar->pekerjaan_ibu ?? '-' }}</div>
        </div>
    </div>
    @endif

    <h3 style="margin-top: 20px; border-bottom: 2px solid #333; padding-bottom: 5px;">Jurusan yang Dipilih</h3>
    <div class="info-box">
        <div class="info-row">
            <div class="info-label">Jurusan</div>
            <div class="info-value">: {{ $pendaftar->jurusan_nama ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-value">: {{ $pendaftar->status }}</div>
        </div>
    </div>

    @if(isset($pembayaran) && strtolower($pembayaran->status) == 'verified')
    <h3 style="margin-top: 20px; border-bottom: 2px solid #333; padding-bottom: 5px;">Informasi Pembayaran</h3>
    <div class="info-box" style="background-color: #f0f9ff; border-color: #0ea5e9;">
        <div class="info-row">
            <div class="info-label">Nominal Pembayaran</div>
            <div class="info-value">: Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Transfer</div>
            <div class="info-value">: {{ \Carbon\Carbon::parse($pembayaran->tanggal_transfer)->format('d F Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Status Pembayaran</div>
            <div class="info-value" style="color: #16a34a; font-weight: bold;">: LUNAS / TERVERIFIKASI</div>
        </div>
    </div>
    @endif

    <div class="footer">
        <p>Bandung, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <div class="signature">
            <p>Panitia PPDB</p>
            <div style="height: 60px;"></div>
            <div class="signature-line"></div>
            <p>(__________________)</p>
        </div>
    </div>

    <p style="margin-top: 30px; font-size: 10px; text-align: center; color: #666;">
        Dokumen ini dicetak secara otomatis dan sah tanpa tanda tangan basah
    </p>
</body>
</html>
