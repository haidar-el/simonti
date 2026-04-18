@extends('layouts.app')
@section('title', 'Rekap Nilai & Absensi')
@section('page-title', 'Rekap Nilai & Absensi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Rekapitulasi Peserta Bimbingan</h3>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th><th>NIM</th>
                    <th>Hadir</th><th>Sakit</th><th>Izin</th><th>Alfa</th>
                    <th>% Kehadiran</th><th>Rata-rata Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekapData as $r)
                <tr>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $r['peserta']->nama }}</td>
                    <td>{{ $r['peserta']->nim }}</td>
                    <td><span class="badge badge-hadir">{{ $r['hadir'] }}</span></td>
                    <td><span class="badge badge-sakit">{{ $r['sakit'] }}</span></td>
                    <td><span class="badge badge-izin">{{ $r['izin'] }}</span></td>
                    <td><span class="badge badge-alfa">{{ $r['alfa'] }}</span></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div class="progress-bar-bg" style="width: 80px;">
                                <div class="progress-bar-fill" style="width: {{ $r['persentase'] }}%;"></div>
                            </div>
                            <strong style="color: {{ $r['persentase'] >= 80 ? 'var(--accent-green)' : 'var(--accent-red)' }};">
                                {{ $r['persentase'] }}%
                            </strong>
                        </div>
                    </td>
                    <td>
                        @if($r['rata_rata_nilai'] !== null)
                            <strong style="color: var(--accent-blue); font-size: 16px;">{{ $r['rata_rata_nilai'] }}</strong>
                        @else
                            <span style="color: var(--text-muted);">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8"><div class="empty-state"><i class="fas fa-chart-bar"></i><p>Belum ada data peserta</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
