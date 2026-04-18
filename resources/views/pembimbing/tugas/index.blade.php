@extends('layouts.app')
@section('title', 'Kelola Tugas')
@section('page-title', 'Kelola Tugas')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Tugas</h3>
        <a href="{{ route('pembimbing.tugas.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Buat Tugas
        </a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>Judul</th><th>Diberikan Kepada</th><th>Deadline</th><th>Status</th><th>Nilai</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($tugas as $t)
                <tr>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $t->judul }}</td>
                    <td>{{ $t->assignedTo->nama ?? '-' }}</td>
                    <td>{{ $t->deadline?->format('d/m/Y') ?? '-' }}</td>
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
                            <strong style="color: var(--accent-blue);">{{ $t->submission->nilai }}</strong>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('pembimbing.tugas.show', $t) }}" class="btn btn-outline btn-icon"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('pembimbing.tugas.edit', $t) }}" class="btn btn-warning btn-icon"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('pembimbing.tugas.destroy', $t) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus tugas ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="empty-state"><i class="fas fa-tasks"></i><p>Belum ada tugas</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
