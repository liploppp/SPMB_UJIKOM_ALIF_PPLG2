@extends('layouts.admin')

@section('title', 'Rekap Pembayaran')

@push('styles')
<style>
.keuangan-table {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.keuangan-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
}

.stats-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 25px;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 15px;
}

.stats-icon.green {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.stats-icon.blue {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}

.stats-icon.yellow {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.stats-value {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.stats-label {
    color: #64748b;
    font-size: 14px;
    font-weight: 500;
}

.keuangan-table table {
    width: 100%;
    border-collapse: collapse;
}

.keuangan-table th {
    background: #f8fafc;
    padding: 15px;
    font-weight: 600;
    color: #475569;
    border-bottom: 2px solid #e2e8f0;
    text-align: left;
}

.keuangan-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
    vertical-align: middle;
}

.keuangan-table tr:hover {
    background: #f8fafc;
    transition: all 0.2s ease;
}

.no-pendaftaran {
    font-family: 'Courier New', monospace;
    font-weight: bold;
    color: #1e40af;
    background: #eff6ff;
    padding: 4px 8px;
    border-radius: 6px;
    border: 1px solid #bfdbfe;
}

.nominal {
    font-weight: 700;
    color: #059669;
    font-size: 14px;
}

.nama-pendaftar {
    font-weight: 600;
    color: #374151;
}

.tanggal {
    color: #6b7280;
    font-size: 13px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
}

.empty-state i {
    font-size: 48px;
    margin-bottom: 16px;
    opacity: 0.5;
}

.page-header {
    margin-bottom: 30px;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.page-subtitle {
    color: #64748b;
    font-size: 16px;
}
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="page-header">
        <h2 class="page-title">📊 Rekap Pembayaran</h2>
        <p class="page-subtitle">Ringkasan dan statistik pembayaran pendaftar</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="stats-card">
            <div class="stats-icon green">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stats-value">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</div>
            <div class="stats-label">💰 Total Pembayaran</div>
        </div>
        
        <div class="stats-card">
            <div class="stats-icon blue">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-value">{{ $totalVerified }}</div>
            <div class="stats-label">✅ Terverifikasi</div>
        </div>
        
        <div class="stats-card">
            <div class="stats-icon yellow">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-value">{{ $totalPending }}</div>
            <div class="stats-label">⏳ Pending</div>
        </div>
    </div>

    <!-- Payment List -->
    <div class="keuangan-table">
        <div class="keuangan-header">
            <h5 class="text-lg font-semibold mb-0">✅ Pembayaran Terverifikasi</h5>
        </div>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Nama Pendaftar</th>
                        <th>Nominal</th>
                        <th>Tanggal Bayar</th>
                        <th>Tanggal Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $item)
                    <tr>
                        <td>
                            <span class="no-pendaftaran">{{ $item->pendaftar->no_pendaftaran ?? '-' }}</span>
                        </td>
                        <td>
                            <span class="nama-pendaftar">{{ $item->pendaftar->dataSiswa->nama ?? '-' }}</span>
                        </td>
                        <td>
                            <span class="nominal">Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="tanggal">{{ $item->tanggal_bayar ? $item->tanggal_bayar->format('d/m/Y') : ($item->tanggal_transfer ? $item->tanggal_transfer->format('d/m/Y') : '-') }}</span>
                        </td>
                        <td>
                            <span class="tanggal">{{ $item->verified_at ? $item->verified_at->format('d/m/Y H:i') : '-' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-receipt"></i>
                                <h4>Belum ada pembayaran terverifikasi</h4>
                                <p>Data pembayaran yang sudah diverifikasi akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pembayaran->hasPages())
        <div style="padding: 20px; border-top: 1px solid #e2e8f0;">
            {{ $pembayaran->links() }}
        </div>
        @endif
    </div>
</div>
@endsection