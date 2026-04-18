<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama', 'email', 'password', 'role', 'pembimbing_id',
        'nim', 'jenis_kelamin', 'no_hp', 'institusi', 'jurusan',
        'tingkat_pendidikan', 'durasi_pkl', 'tanggal_masuk', 'tanggal_keluar',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'tanggal_masuk' => 'date',
            'tanggal_keluar' => 'date',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPembimbing(): bool
    {
        return $this->role === 'pembimbing';
    }

    public function isPeserta(): bool
    {
        return $this->role === 'peserta';
    }

    // Pembimbing dari peserta ini
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    // Peserta magang di bawah bimbingan pembimbing ini
    public function pesertaMagangs()
    {
        return $this->hasMany(User::class, 'pembimbing_id');
    }

    // Absensi milik user ini
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    // Tugas yang di-assign ke peserta ini
    public function tugasDiterima()
    {
        return $this->hasMany(Tugas::class, 'assigned_to');
    }

    // Tugas yang dibuat pembimbing ini
    public function tugasDibuat()
    {
        return $this->hasMany(Tugas::class, 'pembimbing_id');
    }

    // Submissions milik user ini
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // Hitung rata-rata nilai dari semua submission yang sudah dinilai
    public function getRataRataNilaiAttribute()
    {
        $avg = $this->submissions()->whereNotNull('nilai')->avg('nilai');
        return $avg ? round($avg, 1) : null;
    }

    // Hitung persentase kehadiran
    public function getPersentaseKehadiranAttribute()
    {
        $total = $this->absensi()->count();
        if ($total === 0) return null;
        $hadir = $this->absensi()->where('status', 'hadir')->count();
        return round(($hadir / $total) * 100, 1);
    }
}
