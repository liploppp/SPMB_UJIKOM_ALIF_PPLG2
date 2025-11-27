@props(['gelombang'])

<div class="gelombang-status">
    @if($gelombang->status === 'aktif')
        <span class="badge bg-success">
            <i class="fas fa-circle-check me-1"></i>
            Sedang Berlangsung
        </span>
    @elseif($gelombang->status === 'belum_mulai')
        <span class="badge bg-warning">
            <i class="fas fa-clock me-1"></i>
            Belum Mulai
        </span>
    @else
        <span class="badge bg-secondary">
            <i class="fas fa-times-circle me-1"></i>
            Selesai
        </span>
    @endif
</div>