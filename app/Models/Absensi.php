<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'user_id', 'tanggal', 'clock_in', 'clock_out',
        'catatan_kegiatan', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'clock_in' => 'datetime',
            'clock_out' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
