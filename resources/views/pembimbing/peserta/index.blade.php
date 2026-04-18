@extends('layouts.app')
@section('title', 'Kelola Peserta')
@section('page-title', 'Kelola Peserta Magang')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Peserta</h3>
        <a href="{{ route('pembimbing.peserta.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Peserta
        </a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th><th>Nama</th><th>NIM</th><th>Email</th>
                    <th>Institusi</th><th>Jurusan</th><th>Tingkat</th><th>Periode</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertaList as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $p->nama }}</td>
                    <td>{{ $p->nim }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->institusi }}</td>
                    <td>{{ $p->jurusan }}</td>
                    <td><span class="badge badge-hadir">{{ $p->tingkat_pendidikan }}</span></td>
                    <td>{{ $p->tanggal_masuk?->format('d/m/Y') }} - {{ $p->tanggal_keluar?->format('d/m/Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('pembimbing.peserta.edit', $p) }}" class="btn btn-warning btn-icon"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('pembimbing.peserta.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus peserta ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9"><div class="empty-state"><i class="fas fa-user-graduate"></i><p>Belum ada data peserta</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
