<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran - {{ $pendaftar->no_pendaftaran }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header h2 { margin: 5px 0; font-size: 16px; color: #333; }
        .header p { margin: 2px 0; font-size: 11px; }
        .content { margin: 20px 0; }
        .row { display: flex; margin-bottom: 8px; }
        .label { width: 150px; font-weight: bold; }
        .value { flex: 1; }
        .section { margin: 20px 0; }
        .section-title { font-weight: bold; font-size: 14px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .footer { margin-top: 30px; text-align: right; }
        .signature { margin-top: 50px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        td { padding: 5px; vertical-align: top; }
        .border { border: 1px solid #000; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMK BAKTI NUSANTARA 666</h1>
        <h2>BUKTI PENDAFTARAN PPDB</h2>
        <p>Jl. Pendidikan No. 123, Jakarta | Telp: (021) 1234567 | Email: info@smkbn666.sch.id</p>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">INFORMASI PENDAFTARAN</div>
            <table>
                <tr>
                    <td class="label">No. Pendaftaran</td>
                    <td>: {{ $pendaftar->no_pendaftaran }}</td>
                    <td class="label">Tanggal Daftar</td>
                    <td>: {{ $pendaftar->tanggal_daftar->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Gelombang</td>
                    <td>: {{ $pendaftar->gelombang->nama ?? 'Gelombang 1' }}</td>
                    <td class="label">Jurusan Pilihan</td>
                    <td>: {{ $pendaftar->jurusan->nama }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">DATA CALON SISWA</div>
            <table>
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td>: {{ $pendaftar->dataSiswa->nama ?? '-' }}</td>
                    <td class="label">NIK</td>
                    <td>: {{ $pendaftar->dataSiswa->nik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">NISN</td>
                    <td>: {{ $pendaftar->dataSiswa->nisn ?? '-' }}</td>
                    <td class="label">Jenis Kelamin</td>
                    <td>: {{ $pendaftar->dataSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td class="label">Tempat, Tgl Lahir</td>
                    <td>: {{ $pendaftar->dataSiswa->tmp_lahir ?? '-' }}, {{ $pendaftar->dataSiswa->tgl_lahir ? \Carbon\Carbon::parse($pendaftar->dataSiswa->tgl_lahir)->format('d/m/Y') : '-' }}</td>
                    <td class="label">Alamat</td>
                    <td>: {{ $pendaftar->dataSiswa->alamat ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">DATA ORANG TUA</div>
            <table>
                <tr>
                    <td class="label">Nama Ayah</td>
                    <td>: {{ $pendaftar->dataOrtu->nama_ayah ?? '-' }}</td>
                    <td class="label">Pekerjaan Ayah</td>
                    <td>: {{ $pendaftar->dataOrtu->pekerjaan_ayah ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Ibu</td>
                    <td>: {{ $pendaftar->dataOrtu->nama_ibu ?? '-' }}</td>
                    <td class="label">Pekerjaan Ibu</td>
                    <td>: {{ $pendaftar->dataOrtu->pekerjaan_ibu ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">ASAL SEKOLAH</div>
            <table>
                <tr>
                    <td class="label">Nama Sekolah</td>
                    <td>: {{ $pendaftar->asalSekolah->nama_sekolah ?? '-' }}</td>
                    <td class="label">NPSN</td>
                    <td>: {{ $pendaftar->asalSekolah->npsn ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Kabupaten</td>
                    <td>: {{ $pendaftar->asalSekolah->kabupaten ?? '-' }}</td>
                    <td class="label">Nilai Rata-rata</td>
                    <td>: {{ $pendaftar->asalSekolah->nilai_rata ?? '-' }}</td>
                </tr>
            </table>
        </div>

        @if($pembayaran && strtolower($pembayaran->status) == 'verified')
        <div class="section">
            <div class="section-title">INFORMASI PEMBAYARAN</div>
            <table>
                <tr>
                    <td class="label">Nominal Pembayaran</td>
                    <td>: Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                    <td class="label">Tanggal Transfer</td>
                    <td>: {{ $pembayaran->tanggal_transfer ? \Carbon\Carbon::parse($pembayaran->tanggal_transfer)->format('d/m/Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Status Pembayaran</td>
                    <td colspan="3">: <strong>LUNAS / TERVERIFIKASI</strong></td>
                </tr>
            </table>
        </div>
        @endif

        <div class="section">
            <div class="section-title">STATUS PENDAFTARAN</div>
            <table class="border">
                <tr>
                    <td class="border" style="text-align: center; padding: 15px;">
                        <strong>STATUS: {{ strtoupper($pendaftar->status) }}</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        <div class="signature">
            <p>Jakarta, {{ now()->format('d F Y') }}</p>
            <p>Panitia PPDB</p>
            <br><br><br>
            <p>_________________________</p>
            <p>Kepala Sekolah</p>
        </div>
    </div>

    <div style="margin-top: 30px; font-size: 10px; color: #666;">
        <p><strong>Catatan:</strong></p>
        <p>1. Bukti pendaftaran ini adalah dokumen resmi SMK BAKTI NUSANTARA 666</p>
        <p>2. Simpan bukti ini dengan baik untuk keperluan administrasi selanjutnya</p>
        <p>3. Untuk informasi lebih lanjut hubungi panitia PPDB</p>
    </div>
</body>
</html>