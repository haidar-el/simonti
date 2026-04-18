<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Tugas;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        $tugasPending = Tugas::where('assigned_to', $user->id)
            ->whereDoesntHave('submission', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->count();

        $totalTugas = Tugas::where('assigned_to', $user->id)->count();

        $rataRataNilai = $user->rata_rata_nilai;
        $persentaseKehadiran = $user->persentase_kehadiran;

        return view('peserta.dashboard', compact(
            'absensiHariIni', 'tugasPending', 'totalTugas',
            'rataRataNilai', 'persentaseKehadiran'
        ));
    }
}
