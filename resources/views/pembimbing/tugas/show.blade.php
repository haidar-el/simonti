@extends('layouts.app')
@section('title', 'Detail Tugas')
@section('page-title', 'Detail Tugas')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header">
        <h3>{{ $tuga->judul }}</h3>
        <a href="{{ route('pembimbing.tugas.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <div class="stat-label mb-3">Deskripsi</div>
            <p style="color: var(--text-secondary); line-height: 1.7;">{{ $tuga->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>
        <div class="form-row mb-4">
            <div>
                <div class="stat-label">Diberikan Kepada</div>
                <p style="color: var(--text-primary); font-weight: 500; margin-top: 4px;">{{ $tuga->assignedTo->nama ?? '-' }}</p>
            </div>
            <div>
                <div class="stat-label">Deadline</div>
                <p style="color: var(--text-primary); margin-top: 4px;">{{ $tuga->deadline?->format('d F Y') ?? '-' }}</p>
            </div>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border-color); margin: 20px 0;">

        <h4 style="font-size: 15px; margin-bottom: 16px;">Submission</h4>

        @if($tuga->submission)
            <div style="background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.15); border-radius: 12px; padding: 16px;">
                <div class="d-flex justify-between items-center mb-3">
                    <div>
                        <div class="stat-label">File</div>
                        <p style="color: var(--accent-blue); margin-top: 4px;">
                            <i class="fas fa-file"></i> {{ $tuga->submission->file_name }}
                        </p>
                    </div>
                    <a href="{{ asset('storage/' . $tuga->submission->file_path) }}" target="_blank" class="btn btn-outline btn-sm">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
                <div class="stat-label">Dikumpulkan: {{ $tuga->submission->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <div style="margin-top: 20px;">
                <form action="{{ route('pembimbing.submission.nilai', $tuga->submission) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nilai (0-100) *</label>
                            <input type="number" name="nilai" class="form-control" min="0" max="100"
                                   value="{{ old('nilai', $tuga->submission->nilai) }}" required>
                            @error('nilai') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Komentar</label>
                            <input type="text" name="komentar" class="form-control"
                                   value="{{ old('komentar', $tuga->submission->komentar) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-star"></i> Beri Nilai</button>
                </form>
            </div>
        @else
            <div class="empty-state" style="padding: 24px;">
                <i class="fas fa-inbox" style="font-size: 32px;"></i>
                <p>Belum ada submission</p>
            </div>
        @endif
    </div>
</div>
@endsection
