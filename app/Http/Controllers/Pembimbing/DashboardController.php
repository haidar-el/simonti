<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Absensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pembimbing = auth()->user();
        $pesertaList = User::where('pembimbing_id', $pembimbing->id)
            ->where('role', 'peserta')
            ->get();

        $totalPeserta = $pesertaList->count();
        $today = Carbon::today()->toDateString();

        // Hitung yang sudah absen hari ini
        $absenHariIni = Absensi::whereIn('user_id', $pesertaList->pluck('id'))
            ->where('tanggal', $today)
            ->where('status', 'hadir')
            ->count();

        return view('pembimbing.dashboard', compact('pesertaList', 'totalPeserta', 'absenHariIni'));
    }
}
