@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-user-tie"></i></div>
        <div class="stat-value">{{ $totalPembimbing }}</div>
        <div class="stat-label">Total Pembimbing</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-user-graduate"></i></div>
        <div class="stat-value">{{ $totalPeserta }}</div>
        <div class="stat-label">Total Peserta Magang</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-info-circle"></i> &nbsp;Informasi Sistem</h3>
    </div>
    <div class="card-body">
        <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.8;">
            Selamat datang di <strong>SIMONTI</strong> — Sistem Monitoring Internship PT Industri Telekomunikasi Indonesia.<br>
            Sebagai Admin, Anda dapat mengelola akun Pembimbing melalui menu <strong>Kelola Pembimbing</strong> di sidebar.
        </p>
    </div>
</div>
@endsection
