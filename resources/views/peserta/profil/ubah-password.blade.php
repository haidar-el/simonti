@extends('layouts.app')
@section('title', 'Ubah Password')
@section('page-title', 'Ubah Password')

@section('content')
<div class="card" style="max-width: 500px;">
    <div class="card-header"><h3>Ubah Password</h3></div>
    <div class="card-body">
        <form action="{{ route('peserta.profil.updatePassword') }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Password Lama *</label>
                <input type="password" name="password_lama" class="form-control" required>
                @error('password_lama') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password Baru *</label>
                <input type="password" name="password_baru" class="form-control" required>
                @error('password_baru') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru *</label>
                <input type="password" name="password_baru_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-key"></i> Ubah Password
            </button>
        </form>
    </div>
</div>
@endsection
