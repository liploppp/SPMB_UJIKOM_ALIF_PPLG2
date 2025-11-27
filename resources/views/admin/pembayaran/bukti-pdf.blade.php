<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px; }
        .school-name { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        .title { font-size: 16px; font-weight: bold; margin-top: 15px; }
        .content { margin: 20px 0; }
        .info-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .info-table td { padding: 8px; border-bottom: 1px solid #ddd; }
        .info-table .label { width: 200px; font-weight: bold; }
        .status-verified { background: #28a745; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; }
        .footer { margin-top: 40px; text-align: right; }
        .signature { margin-top: 60px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="school-name">SMK BAKTI NUSANTARA 666</div>
        <div>Jl. Pendidikan No. 123, Kota Pendidikan</div>
        <div class="title">BUKTI PEMBAYARAN PPDB</div>
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td class="label">No. Pendaftaran</td>
                <td>: {{ $pembayaran->pendaftar->no_pendaftaran }}</td>
            </tr>
            <tr>
                <td class="label">Nama Siswa</td>
                <td>: {{ $pembayaran->pendaftar->dataSiswa->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jurusan</td>
                <td>: {{ $pembayaran->pendaftar->jurusan->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jumlah Pembayaran</td>
                <td>: Rp {{ number_format($pembayaran->nominal ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Metode Pembayaran</td>
                <td>: {{ ucfirst($pembayaran->metode_pembayaran ?? 'Transfer Bank') }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Bayar</td>
                <td>: {{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d/m/Y') : ($pembayaran->tanggal_transfer ? $pembayaran->tanggal_transfer->format('d/m/Y') : '-') }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td>: <span class="status-verified">TERVERIFIKASI</span></td>
            </tr>
            <tr>
                <td class="label">Tanggal Verifikasi</td>
                <td>: {{ $pembayaran->verified_at ? $pembayaran->verified_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
        </table>

        <p><strong>Keterangan:</strong></p>
        <p>Bukti pembayaran ini merupakan tanda bahwa pembayaran pendaftaran telah diterima dan diverifikasi oleh pihak sekolah. Simpan bukti ini sebagai arsip.</p>
    </div>

    <div class="footer">
        <div>{{ now()->format('d/m/Y') }}</div>
        <div class="signature">
            <p>Staff Keuangan</p>
            <br><br>
            <p>(_________________)</p>
        </div>
    </div>
</body>
</html>