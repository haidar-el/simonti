@extends('layouts.app')
@section('title', 'Absensi')
@section('page-title', 'Absensi Saya')

@section('content')
<!-- Stats -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-check"></i></div>
        <div class="stat-value">{{ $totalHadir }}</div>
        <div class="stat-label">Hadir</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-thermometer"></i></div>
        <div class="stat-value">{{ $totalSakit }}</div>
        <div class="stat-label">Sakit</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon cyan"><i class="fas fa-envelope"></i></div>
        <div class="stat-value">{{ $totalIzin }}</div>
        <div class="stat-label">Izin</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-times"></i></div>
        <div class="stat-value">{{ $totalAlfa }}</div>
        <div class="stat-label">Alfa</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-percentage"></i></div>
        <div class="stat-value">{{ $persentase }}%</div>
        <div class="stat-label">Kehadiran</div>
        <div class="progress-bar-bg mt-3">
            <div class="progress-bar-fill" style="width: {{ $persentase }}%;"></div>
        </div>
    </div>
</div>

<!-- Clock In/Out -->
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-clock"></i> &nbsp;Absensi Hari Ini — {{ \Carbon\Carbon::today()->format('d F Y') }}</h3>
    </div>
    <div class="card-body text-center" style="padding: 32px;">
        @if(!$absensiHariIni || !$absensiHariIni->clock_in)
            <!-- Clock In Form -->
            <form action="{{ route('peserta.absensi.clockIn') }}" method="POST">
                @csrf
                <div class="form-group" style="max-width: 500px; margin: 0 auto 20px; text-align: left;">
                    <label class="form-label">Catatan Kegiatan Hari Ini *</label>
                    <textarea name="catatan_kegiatan" class="form-control" rows="3"
                              placeholder="Tuliskan rencana kegiatan hari ini (minimal 10 karakter)..." required>{{ old('catatan_kegiatan') }}</textarea>
                    @error('catatan_kegiatan') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="clock-btn clock-in">
                    <i class="fas fa-sign-in-alt"></i> Clock In
                </button>
            </form>
        @elseif(!$absensiHariIni->clock_out)
            <!-- Clock Out -->
            <div style="margin-bottom: 16px;">
                <span class="badge badge-hadir" style="font-size: 14px; padding: 8px 16px;">
                    Clock In: {{ $absensiHariIni->clock_in->format('H:i:s') }}
                </span>
            </div>
            <p style="color: var(--text-secondary); margin-bottom: 20px;">
                Catatan: {{ $absensiHariIni->catatan_kegiatan }}
            </p>
            <form action="{{ route('peserta.absensi.clockOut') }}" method="POST">
                @csrf
                <button type="submit" class="clock-btn clock-out"
                        onclick="return confirm('Yakin ingin Clock Out?')">
                    <i class="fas fa-sign-out-alt"></i> Clock Out
                </button>
            </form>
        @else
            <!-- Done -->
            <div style="margin-bottom: 12px;">
                <span class="badge badge-hadir" style="font-size: 14px; padding: 8px 16px;">
                    Clock In: {{ $absensiHariIni->clock_in->format('H:i:s') }}
                </span>
                &nbsp;
                <span class="badge badge-submitted" style="font-size: 14px; padding: 8px 16px;">
                    Clock Out: {{ $absensiHariIni->clock_out->format('H:i:s') }}
                </span>
            </div>
            <p style="color: var(--text-secondary);">Catatan: {{ $absensiHariIni->catatan_kegiatan }}</p>
            <button class="clock-btn clock-disabled" disabled>
                <i class="fas fa-check-circle"></i> Absensi Selesai
            </button>
        @endif
    </div>
</div>

<!-- Riwayat -->
<div class="card">
    <div class="card-header"><h3>Riwayat Absensi</h3></div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>Tanggal</th><th>Status</th><th>Clock In</th><th>Clock Out</th><th>Catatan</th></tr>
            </thead>
            <tbody>
                @forelse($riwayat as $r)
                <tr>
                    <td style="color: var(--text-primary);">{{ $r->tanggal->format('d/m/Y') }}</td>
                    <td><span class="badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                    <td>{{ $r->clock_in?->format('H:i') ?? '-' }}</td>
                    <td>{{ $r->clock_out?->format('H:i') ?? '-' }}</td>
                    <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $r->catatan_kegiatan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state"><i class="fas fa-clock"></i><p>Belum ada riwayat absensi</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($riwayat->hasPages())
    <div class="card-body">
        {{ $riwayat->links() }}
    </div>
    @endif
</div>
@endsection
