@extends('layouts.app')
@section('title', 'Edit Peserta')
@section('page-title', 'Edit Peserta Magang')

@section('content')
<div class="card" style="max-width: 800px;">
    <div class="card-header"><h3>Edit Data Peserta</h3></div>
    <div class="card-body">
        <form action="{{ route('pembimbing.peserta.update', $pesertum) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pesertum->nama) }}" required>
                    @error('nama') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $pesertum->email) }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">NIM *</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim', $pesertum->nim) }}" required>
                    @error('nim') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin *</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="L" {{ old('jenis_kelamin', $pesertum->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pesertum->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pesertum->no_hp) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Institusi *</label>
                    <input type="text" name="institusi" class="form-control" value="{{ old('institusi', $pesertum->institusi) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jurusan *</label>
                    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $pesertum->jurusan) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tingkat Pendidikan *</label>
                    <select name="tingkat_pendidikan" class="form-control" required>
                        <option value="D3" {{ old('tingkat_pendidikan', $pesertum->tingkat_pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ old('tingkat_pendidikan', $pesertum->tingkat_pendidikan) == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="S1" {{ old('tingkat_pendidikan', $pesertum->tingkat_pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi PKL *</label>
                    <input type="text" name="durasi_pkl" class="form-control" value="{{ old('durasi_pkl', $pesertum->durasi_pkl) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Masuk *</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $pesertum->tanggal_masuk?->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Keluar *</label>
                    <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar', $pesertum->tanggal_keluar?->format('Y-m-d')) }}" required>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('pembimbing.peserta.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
