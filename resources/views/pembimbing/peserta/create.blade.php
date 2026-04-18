@extends('layouts.app')
@section('title', 'Tambah Peserta')
@section('page-title', 'Tambah Peserta Magang')

@section('content')
<div class="card" style="max-width: 800px;">
    <div class="card-header"><h3>Form Tambah Peserta</h3></div>
    <div class="card-body">
        <form action="{{ route('pembimbing.peserta.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    @error('nama') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">NIM *</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
                    @error('nim') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin *</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Institusi *</label>
                    <input type="text" name="institusi" class="form-control" value="{{ old('institusi') }}" required>
                    @error('institusi') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jurusan *</label>
                    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                    @error('jurusan') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tingkat Pendidikan *</label>
                    <select name="tingkat_pendidikan" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="D3" {{ old('tingkat_pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ old('tingkat_pendidikan') == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="S1" {{ old('tingkat_pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                    </select>
                    @error('tingkat_pendidikan') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi PKL *</label>
                    <input type="text" name="durasi_pkl" class="form-control" value="{{ old('durasi_pkl') }}" placeholder="Contoh: 3 bulan" required>
                    @error('durasi_pkl') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Masuk *</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}" required>
                    @error('tanggal_masuk') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Keluar *</label>
                    <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar') }}" required>
                    @error('tanggal_keluar') <div class="form-error">{{ $message }}</div> @enderror
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
