@extends('layouts.app')
@section('title', 'Tugas Saya')
@section('page-title', 'Tugas Saya')

@section('content')
<div class="card">
    <div class="card-header"><h3>Daftar Tugas</h3></div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>Judul</th><th>Deadline</th><th>Status</th><th>Nilai</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($tugasList as $t)
                <tr>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $t->judul }}</td>
                    <td>
                        @if($t->deadline)
                            <span style="color: {{ $t->deadline->isPast() && !$t->submission ? 'var(--accent-red)' : 'var(--text-secondary)' }};">
                                {{ $t->deadline->format('d/m/Y') }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($t->submission)
                            @if($t->submission->nilai !== null)
                                <span class="badge badge-graded">Dinilai</span>
                            @else
                                <span class="badge badge-submitted">Dikumpulkan</span>
                            @endif
                        @else
                            <span class="badge badge-pending">Belum Dikumpulkan</span>
                        @endif
                    </td>
                    <td>
                        @if($t->submission && $t->submission->nilai !== null)
                            <strong style="color: var(--accent-blue); font-size: 16px;">{{ $t->submission->nilai }}</strong>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('peserta.tugas.show', $t) }}" class="btn btn-outline btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state"><i class="fas fa-book"></i><p>Belum ada tugas</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
