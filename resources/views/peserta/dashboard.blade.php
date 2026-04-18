@extends('layouts.app')
@section('title', 'Dashboard Peserta')
@section('page-title', 'Dashboard Peserta')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon {{ $absensiHariIni ? ($absensiHariIni->clock_out ? 'green' : 'blue') : 'red' }}">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-value" style="font-size: 18px;">
            @if($absensiHariIni)
                @if($absensiHariIni->clock_out)
                    ✅ Sudah Clock Out
                @else
                    🕐 Sudah Clock In
                @endif
            @else
                ❌ Belum Absen
            @endif
        </div>
        <div class="stat-label">Status Hari Ini</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-tasks"></i></div>
        <div class="stat-value">{{ $tugasPending }}</div>
        <div class="stat-label">Tugas Belum Dikumpulkan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-book"></i></div>
        <div class="stat-value">{{ $totalTugas }}</div>
        <div class="stat-label">Total Tugas</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon cyan"><i class="fas fa-chart-line"></i></div>
        <div class="stat-value">{{ $persentaseKehadiran ?? '-' }}%</div>
        <div class="stat-label">Persentase Kehadiran</div>
        @if($persentaseKehadiran)
        <div class="progress-bar-bg mt-3">
            <div class="progress-bar-fill" style="width: {{ $persentaseKehadiran }}%;"></div>
        </div>
        @endif
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-star"></i></div>
        <div class="stat-value">{{ $rataRataNilai ?? '-' }}</div>
        <div class="stat-label">Rata-rata Nilai</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-info-circle"></i> &nbsp;Informasi</h3>
    </div>
    <div class="card-body">
        <p style="color: var(--text-secondary); line-height: 1.8;">
            Selamat datang, <strong>{{ auth()->user()->nama }}</strong>!<br>
            Pembimbing Anda: <strong>{{ auth()->user()->pembimbing->nama ?? '-' }}</strong><br>
            Periode magang: <strong>{{ auth()->user()->tanggal_masuk?->format('d/m/Y') }} - {{ auth()->user()->tanggal_keluar?->format('d/m/Y') }}</strong>
        </p>
    </div>
</div>
@endsection
