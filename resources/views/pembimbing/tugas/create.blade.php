@extends('layouts.app')
@section('title', 'Buat Tugas')
@section('page-title', 'Buat Tugas Baru')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header"><h3>Form Tugas Baru</h3></div>
    <div class="card-body">
        <form action="{{ route('pembimbing.tugas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Judul Tugas *</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                @error('judul') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Berikan Kepada *</label>
                    <select name="assigned_to" class="form-control" required>
                        <option value="">-- Pilih Peserta --</option>
                        @foreach($pesertaList as $p)
                        <option value="{{ $p->id }}" {{ old('assigned_to') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }} ({{ $p->nim }})
                        </option>
                        @endforeach
                    </select>
                    @error('assigned_to') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('pembimbing.tugas.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
