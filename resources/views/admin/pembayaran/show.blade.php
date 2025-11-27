@extends('layouts.admin')

@section('content')
<div class="w-full">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-700">Detail Pembayaran</h2>
        <a href="{{ session('admin_role') === 'keuangan' ? route('admin.keuangan.daftar') : route('admin.pembayaran.index') }}" class="px-4 py-2 bg-slate-500 text-white rounded-lg hover:bg-slate-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <div class="bg-white rounded-2xl shadow-soft-xl border border-slate-200">
                <div class="p-6 border-b border-slate-200">
                    <h5 class="text-lg font-semibold text-slate-700">Informasi Pembayaran</h5>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">No Pendaftaran</div>
                            <div class="text-slate-800">: {{ $pembayaran->pendaftar->no_pendaftaran ?? '-' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">Nama Siswa</div>
                            <div class="text-slate-800">: {{ $pembayaran->pendaftar->dataSiswa->nama ?? '-' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">Jumlah Bayar</div>
                            <div class="text-slate-800 font-semibold">: Rp {{ number_format($pembayaran->nominal ?? $pembayaran->jumlah ?? 0, 0, ',', '.') }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">Metode Pembayaran</div>
                            <div class="text-slate-800">: {{ ucfirst($pembayaran->metode_pembayaran) }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">Tanggal Bayar</div>
                            <div class="text-slate-800">: {{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d/m/Y H:i') : ($pembayaran->tanggal_transfer ? $pembayaran->tanggal_transfer->format('d/m/Y H:i') : ($pembayaran->created_at ? $pembayaran->created_at->format('d/m/Y H:i') : '-')) }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">Status</div>
                            <div>: 
                                @if(strtolower($pembayaran->status) === 'pending')
                                    <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Menunggu Verifikasi</span>
                                @elseif(strtolower($pembayaran->status) === 'verified')
                                    <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Diterima</span>
                                @elseif(strtolower($pembayaran->status) === 'rejected')
                                    <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">{{ ucfirst($pembayaran->status) }}</span>
                                @endif
                            </div>
                        </div>
                        @if($pembayaran->verified_at)
                        <div class="flex">
                            <div class="w-48 text-slate-600 font-medium">Diverifikasi</div>
                            <div class="text-slate-800">: {{ $pembayaran->verified_at ? $pembayaran->verified_at->format('d/m/Y H:i') : '-' }}</div>
                        </div>
                        @endif
                        @if(strtolower($pembayaran->status) === 'rejected' && $pembayaran->alasan_tolak_pembayaran)
                        <div class="flex flex-col mt-3">
                            <div class="text-slate-600 font-medium mb-2">Alasan Penolakan Pembayaran:</div>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                <p class="text-red-800 text-sm mb-0">{{ $pembayaran->alasan_tolak_pembayaran }}</p>
            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="space-y-6">
            @if($pembayaran->bukti_pembayaran)
            <div class="bg-white rounded-2xl shadow-soft-xl border border-slate-200">
                <div class="p-6 border-b border-slate-200">
                    <h5 class="text-lg font-semibold text-slate-700">Bukti Pembayaran</h5>
                </div>
                <div class="p-6 text-center">
                    <img src="{{ route('admin.pembayaran.bukti', $pembayaran->id) }}" 
                         class="max-w-full h-auto rounded-lg shadow-md" style="max-height: 300px;">
                    <div class="mt-4 space-y-2">
                        <a href="{{ route('admin.pembayaran.bukti', $pembayaran->id) }}" 
                           class="block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm text-center" target="_blank">
                            <i class="fas fa-download mr-2"></i>Download Bukti
                        </a>
                        @if(strtolower($pembayaran->status) === 'verified')
                        <a href="{{ route('admin.pembayaran.cetak-bukti', $pembayaran->id) }}" 
                           class="block px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm text-center">
                            <i class="fas fa-print mr-2"></i>Cetak PDF
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            
            @if(in_array(session('admin_role'), ['keuangan', 'admin']))
            <div class="bg-white rounded-2xl shadow-soft-xl border border-slate-200">
                <div class="p-6 border-b border-slate-200">
                    <h5 class="text-lg font-semibold text-slate-700">Verifikasi Pembayaran</h5>
                </div>
                <div class="p-6">
                    @if(in_array(strtolower($pembayaran->status), ['pending', 'rejected']))
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Data Pembayaran</label>
                        <div class="bg-gray-50 p-3 rounded-lg mb-4">
                            <p class="text-sm"><strong>No Pendaftaran:</strong> {{ $pembayaran->pendaftar->no_pendaftaran ?? '-' }}</p>
                            <p class="text-sm"><strong>Nama Siswa:</strong> {{ $pembayaran->pendaftar->dataSiswa->nama ?? '-' }}</p>
                            <p class="text-sm"><strong>Jumlah:</strong> Rp {{ number_format($pembayaran->nominal ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('admin.pembayaran.verifikasi', $pembayaran->id) }}" id="formTerima">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="verified">
                        <button type="submit" class="inline-block px-6 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-green-600 to-lime-400 hover:shadow-soft-2xl hover:scale-102 active:opacity-85 text-white w-full mb-2">
                            <i class="fas fa-check mr-2"></i>Terima Pembayaran
                        </button>
                    </form>
                    
                    <button type="button" onclick="showRejectPaymentModal()" class="inline-block px-6 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-red-600 to-rose-400 hover:shadow-soft-2xl hover:scale-102 active:opacity-85 text-white w-full">
                        <i class="fas fa-times mr-2"></i>Tolak Pembayaran
                    </button>
                    @else
                    <div class="text-center py-4">
                        <p class="text-slate-600">Pembayaran sudah diverifikasi</p>
                        @if($pembayaran->catatan_verifikasi)
                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                            <p class="text-sm text-slate-700"><strong>Catatan:</strong> {{ $pembayaran->catatan_verifikasi }}</p>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


<!-- Rejection Modal -->
<div id="rejectPaymentModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 12px; padding: 24px; width: 90%; max-width: 500px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 16px; color: #dc2626;">
            <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>Tolak Pembayaran
        </h3>
        <form method="POST" action="{{ route('admin.pembayaran.verifikasi', $pembayaran->id) }}" id="formTolakPembayaran">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 8px;">Alasan Penolakan Pembayaran *</label>
                <textarea name="alasan_tolak_pembayaran" id="alasan_tolak_pembayaran" rows="4" 
                          style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem;" 
                          placeholder="Contoh: Nominal tidak sesuai, bukti transfer tidak jelas, nama pengirim tidak sesuai, dll." required></textarea>
                <small style="color: #6b7280; font-size: 0.75rem;">Minimal 10 karakter, maksimal 500 karakter</small>
            </div>
            
            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="hideRejectPaymentModal()" 
                        style="padding: 8px 16px; color: #4b5563; background: #e5e7eb; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">
                    Batal
                </button>
                <button type="submit" 
                        style="padding: 8px 16px; color: white; background: #dc2626; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">
                    <i class="fas fa-times" style="margin-right: 8px;"></i>Tolak Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showRejectPaymentModal() {
    var modal = document.getElementById('rejectPaymentModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function hideRejectPaymentModal() {
    var modal = document.getElementById('rejectPaymentModal');
    modal.style.display = 'none';
    document.getElementById('alasan_tolak_pembayaran').value = '';
    document.body.style.overflow = 'auto';
}

// Validate form before submit
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('rejectPaymentModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideRejectPaymentModal();
            }
        });
    }
    
    var form = document.getElementById('formTolakPembayaran');
    if (form) {
        form.addEventListener('submit', function(e) {
            var alasan = document.getElementById('alasan_tolak_pembayaran').value.trim();
            if (alasan.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter');
                return false;
            }
            if (alasan.length > 500) {
                e.preventDefault();
                alert('Alasan penolakan maksimal 500 karakter');
                return false;
            }
        });
    }
});
</script>

@endsection