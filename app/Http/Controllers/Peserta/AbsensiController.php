<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        $riwayat = Absensi::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Stats
        $totalAbsensi = Absensi::where('user_id', $user->id)->count();
        $totalHadir = Absensi::where('user_id', $user->id)->where('status', 'hadir')->count();
        $totalSakit = Absensi::where('user_id', $user->id)->where('status', 'sakit')->count();
        $totalIzin = Absensi::where('user_id', $user->id)->where('status', 'izin')->count();
        $totalAlfa = Absensi::where('user_id', $user->id)->where('status', 'alfa')->count();
        $persentase = $totalAbsensi > 0 ? round(($totalHadir / $totalAbsensi) * 100, 1) : 0;

        return view('peserta.absensi.index', compact(
            'absensiHariIni', 'riwayat',
            'totalAbsensi', 'totalHadir', 'totalSakit', 'totalIzin', 'totalAlfa', 'persentase'
        ));
    }

    public function clockIn(Request $request)
    {
        $request->validate([
            'catatan_kegiatan' => 'required|string|min:10',
        ], [
            'catatan_kegiatan.required' => 'Catatan kegiatan wajib diisi sebelum clock in.',
            'catatan_kegiatan.min' => 'Catatan kegiatan minimal 10 karakter.',
        ]);

        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $existing = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        if ($existing && $existing->clock_in) {
            return back()->with('error', 'Anda sudah melakukan Clock In hari ini.');
        }

        Absensi::updateOrCreate(
            ['user_id' => $user->id, 'tanggal' => $today],
            [
                'clock_in' => Carbon::now(),
                'catatan_kegiatan' => $request->catatan_kegiatan,
                'status' => 'hadir',
            ]
        );

        return back()->with('success', 'Clock In berhasil!');
    }

    public function clockOut()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $absensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        if (!$absensi || !$absensi->clock_in) {
            return back()->with('error', 'Anda belum melakukan Clock In hari ini.');
        }

        if ($absensi->clock_out) {
            return back()->with('error', 'Anda sudah melakukan Clock Out hari ini.');
        }

        $absensi->update(['clock_out' => Carbon::now()]);

        return back()->with('success', 'Clock Out berhasil!');
    }
}
