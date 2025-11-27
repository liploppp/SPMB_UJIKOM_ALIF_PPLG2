<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pembayaran Digital</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px; }
        .content { margin: 20px 0; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table td { padding: 8px; border-bottom: 1px solid #ddd; }
        .footer { margin-top: 40px; text-align: center; }
        .status-lunas { color: green; font-weight: bold; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()">Cetak Bukti</button>
        <button onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <h2>SMK BAKTI NUSANTARA 666</h2>
        <p>Jl. Contoh No. 123, Bandung, Jawa Barat</p>
        <h3>BUKTI PEMBAYARAN DIGITAL</h3>
        <p class="status-lunas">STATUS: LUNAS</p>
    </div>

    <div class="content">
        <table class="table">
            <tr>
                <td width="30%"><strong>Kode Pembayaran</strong></td>
                <td>: {{ $pembayaran->kode_pembayaran }}</td>
            </tr>
            <tr>
                <td><strong>Nama Siswa</strong></td>
                <td>: {{ $pembayaran->pendaftar->dataSiswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>No. Pendaftaran</strong></td>
                <td>: {{ $pembayaran->pendaftar->no_pendaftaran }}</td>
            </tr>
            <tr>
                <td><strong>Jumlah Pembayaran</strong></td>
                <td>: Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Bayar</strong></td>
                <td>: {{ $pembayaran->tanggal_bayar->format('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <td><strong>Verifikator</strong></td>
                <td>: {{ $pembayaran->verifikator->nama ?? '-' }}</td>
            </tr>
            @if($pembayaran->catatan)
            <tr>
                <td><strong>Catatan</strong></td>
                <td>: {{ $pembayaran->catatan }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="footer">
        <p>Bukti pembayaran ini dibuat secara digital pada {{ now()->format('d F Y, H:i') }} WIB</p>
        <p><strong>Dokumen ini sah tanpa tanda tangan basah</strong></p>
        <br>
        <p>SMK Bakti Nusantara 666<br>Bagian Keuangan</p>
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