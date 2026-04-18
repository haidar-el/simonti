@extends('layouts.app')
@section('title', 'Absensi Peserta')
@section('page-title', 'Absensi Peserta')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Absensi Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</h3>
        <form action="" method="GET" class="d-flex gap-2">
            <input type="date" name="tanggal" class="form-control" style="width: auto;" value="{{ $tanggal }}">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th><th>Status</th><th>Clock In</th><th>Clock Out</th><th>Catatan</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertaList as $peserta)
                @php $absensi = $absensiData[$peserta->id] ?? null; @endphp
                <tr>
                    <td style="color: var(--text-primary); font-weight: 500;">{{ $peserta->nama }}</td>
                    <td>
                        @if($absensi)
                            <span class="badge badge-{{ $absensi->status }}">{{ ucfirst($absensi->status) }}</span>
                        @else
                            <span style="color: var(--text-muted);">Belum Absen</span>
                        @endif
                    </td>
                    <td>{{ $absensi?->clock_in?->format('H:i') ?? '-' }}</td>
                    <td>{{ $absensi?->clock_out?->format('H:i') ?? '-' }}</td>
                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $absensi?->catatan_kegiatan ?? '-' }}
                    </td>
                    <td>
                        @if($absensi)
                        <form action="{{ route('pembimbing.absensi.updateStatus', $absensi) }}" method="POST" class="d-flex gap-2">
                            @csrf @method('PUT')
                            <select name="status" class="form-control" style="width: auto; padding: 6px 10px; font-size: 12px;">
                                <option value="hadir" {{ $absensi->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="sakit" {{ $absensi->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="izin" {{ $absensi->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="alfa" {{ $absensi->status == 'alfa' ? 'selected' : '' }}>Alfa</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                        </form>
                        @else
                        <form action="{{ route('pembimbing.absensi.manual') }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $peserta->id }}">
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                            <select name="status" class="form-control" style="width: auto; padding: 6px 10px; font-size: 12px;">
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                                <option value="alfa">Alfa</option>
                            </select>
                            <button type="submit" class="btn btn-warning btn-sm">Tambah</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
