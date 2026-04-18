@extends('layouts.app')
@section('title', 'Dashboard Pembimbing')
@section('page-title', 'Dashboard Pembimbing')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-user-graduate"></i></div>
        <div class="stat-value">{{ $totalPeserta }}</div>
        <div class="stat-label">Peserta Bimbingan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-clipboard-check"></i></div>
        <div class="stat-value">{{ $absenHariIni }}</div>
        <div class="stat-label">Absen Hari Ini</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon pink"><i class="fas fa-user-clock"></i></div>
        <div class="stat-value">{{ $totalPeserta - $absenHariIni }}</div>
        <div class="stat-label">Belum Absen</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Daftar Peserta Bimbingan</h3>
        <a href="{{ route('pembimbing.peserta.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Peserta
        </a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Institusi</th>
                    <th>Jurusan</th>
                    <th>Periode</th>
                    <th>Kehadiran</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertaList as $p)
                <tr>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $p->nama }}</td>
                    <td>{{ $p->nim }}</td>
                    <td>{{ $p->institusi }}</td>
                    <td>{{ $p->jurusan }}</td>
                    <td>{{ $p->tanggal_masuk?->format('d/m/Y') }} - {{ $p->tanggal_keluar?->format('d/m/Y') }}</td>
                    <td>
                        @if($p->persentase_kehadiran !== null)
                            <span class="badge {{ $p->persentase_kehadiran >= 80 ? 'badge-hadir' : 'badge-alfa' }}">
                                {{ $p->persentase_kehadiran }}%
                            </span>
                        @else
                            <span style="color: var(--text-muted);">-</span>
                        @endif
                    </td>
                    <td>
                        @if($p->rata_rata_nilai !== null)
                            <strong style="color: var(--accent-blue);">{{ $p->rata_rata_nilai }}</strong>
                        @else
                            <span style="color: var(--text-muted);">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-user-graduate"></i>
                            <p>Belum ada peserta bimbingan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
