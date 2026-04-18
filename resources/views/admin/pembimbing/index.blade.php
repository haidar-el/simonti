@extends('layouts.app')
@section('title', 'Kelola Pembimbing')
@section('page-title', 'Kelola Pembimbing')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Pembimbing</h3>
        <a href="{{ route('admin.pembimbing.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Pembimbing
        </a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Jumlah Peserta</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembimbings as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $p->nama }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_hp ?? '-' }}</td>
                    <td><span class="badge badge-hadir">{{ $p->peserta_magangs_count }} peserta</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.pembimbing.edit', $p) }}" class="btn btn-warning btn-icon" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.pembimbing.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus pembimbing ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-icon" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fas fa-user-tie"></i>
                            <p>Belum ada data pembimbing</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
