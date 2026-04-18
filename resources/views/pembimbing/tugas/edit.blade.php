@extends('layouts.app')
@section('title', 'Edit Tugas')
@section('page-title', 'Edit Tugas')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header"><h3>Edit Tugas</h3></div>
    <div class="card-body">
        <form action="{{ route('pembimbing.tugas.update', $tuga) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Judul Tugas *</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $tuga->judul) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $tuga->deskripsi) }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Berikan Kepada *</label>
                    <select name="assigned_to" class="form-control" required>
                        @foreach($pesertaList as $p)
                        <option value="{{ $p->id }}" {{ old('assigned_to', $tuga->assigned_to) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }} ({{ $p->nim }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $tuga->deadline?->format('Y-m-d')) }}">
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
