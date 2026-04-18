@extends('layouts.app')
@section('title', 'Detail Tugas')
@section('page-title', 'Detail Tugas')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header">
        <h3>{{ $tuga->judul }}</h3>
        <a href="{{ route('peserta.tugas.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <div class="stat-label mb-3">Deskripsi</div>
            <p style="color: var(--text-secondary); line-height: 1.7;">{{ $tuga->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>
        <div class="form-row mb-4">
            <div>
                <div class="stat-label">Dari Pembimbing</div>
                <p style="color: var(--text-primary); font-weight: 500; margin-top: 4px;">{{ $tuga->pembimbing->nama ?? '-' }}</p>
            </div>
            <div>
                <div class="stat-label">Deadline</div>
                <p style="color: var(--text-primary); margin-top: 4px;">{{ $tuga->deadline?->format('d F Y') ?? 'Tidak ditentukan' }}</p>
            </div>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border-color); margin: 20px 0;">

        @if($submission)
            <div style="background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.15); border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                <div class="d-flex justify-between items-center">
                    <div>
                        <div class="stat-label">File yang Dikumpulkan</div>
                        <p style="color: var(--accent-blue); margin-top: 4px;">
                            <i class="fas fa-file"></i> {{ $submission->file_name }}
                        </p>
                        <div class="stat-label mt-3">Dikumpulkan: {{ $submission->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-outline btn-sm">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
            </div>

            @if($submission->nilai !== null)
            <div style="background: rgba(99, 102, 241, 0.05); border: 1px solid rgba(99, 102, 241, 0.15); border-radius: 12px; padding: 16px;">
                <div class="form-row">
                    <div>
                        <div class="stat-label">Nilai</div>
                        <p style="color: var(--accent-blue); font-size: 28px; font-weight: 800; margin-top: 4px;">{{ $submission->nilai }}</p>
                    </div>
                    <div>
                        <div class="stat-label">Komentar</div>
                        <p style="color: var(--text-secondary); margin-top: 4px;">{{ $submission->komentar ?? '-' }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-4">
                <p style="color: var(--text-muted); font-size: 12px;">Ingin mengumpulkan ulang? Upload file baru di bawah (file lama akan diganti).</p>
            </div>
        @endif

        <div class="mt-4">
            <h4 style="font-size: 15px; margin-bottom: 16px;">
                {{ $submission ? 'Upload Ulang' : 'Kumpulkan Tugas' }}
            </h4>
            <form action="{{ route('peserta.tugas.submit', $tuga) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="file-upload" onclick="document.getElementById('fileInput').click()">
                    <input type="file" id="fileInput" name="file"
                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx" required>
                    <div class="file-upload-label">
                        <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="file-upload-text">
                            Klik untuk memilih file<br>
                            <small>JPG, PNG, PDF, DOC, DOCX, XLS, XLSX (Maks 10MB)</small>
                        </div>
                        <div class="file-name-display"></div>
                    </div>
                </div>
                @error('file') <div class="form-error mt-3">{{ $message }}</div> @enderror
                <button type="submit" class="btn btn-primary mt-4">
                    <i class="fas fa-paper-plane"></i> Kumpulkan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
