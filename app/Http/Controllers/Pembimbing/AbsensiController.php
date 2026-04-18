<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $pembimbing = auth()->user();
        $pesertaList = User::where('pembimbing_id', $pembimbing->id)
            ->where('role', 'peserta')
            ->get();

        $tanggal = $request->get('tanggal', Carbon::today()->toDateString());

        $absensiData = Absensi::whereIn('user_id', $pesertaList->pluck('id'))
            ->where('tanggal', $tanggal)
            ->with('user')
            ->get()
            ->keyBy('user_id');

        return view('pembimbing.absensi.index', compact('pesertaList', 'absensiData', 'tanggal'));
    }

    public function updateStatus(Request $request, Absensi $absensi)
    {
        // Pastikan absensi milik peserta di bawah pembimbing ini
        $peserta = User::find($absensi->user_id);
        if (!$peserta || $peserta->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alfa',
        ]);

        $absensi->update(['status' => $request->status]);

        return back()->with('success', 'Status absensi berhasil diperbarui.');
    }

    public function tambahManual(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:sakit,izin,alfa',
        ]);

        $peserta = User::findOrFail($request->user_id);
        if ($peserta->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        Absensi::updateOrCreate(
            ['user_id' => $request->user_id, 'tanggal' => $request->tanggal],
            ['status' => $request->status]
        );

        return back()->with('success', 'Absensi manual berhasil ditambahkan.');
    }

    public function rekap()
    {
        $pembimbing = auth()->user();
        $pesertaList = User::where('pembimbing_id', $pembimbing->id)
            ->where('role', 'peserta')
            ->get();

        $rekapData = [];
        foreach ($pesertaList as $peserta) {
            $totalAbsensi = $peserta->absensi()->count();
            $hadir = $peserta->absensi()->where('status', 'hadir')->count();
            $sakit = $peserta->absensi()->where('status', 'sakit')->count();
            $izin = $peserta->absensi()->where('status', 'izin')->count();
            $alfa = $peserta->absensi()->where('status', 'alfa')->count();

            $rekapData[] = [
                'peserta' => $peserta,
                'total' => $totalAbsensi,
                'hadir' => $hadir,
                'sakit' => $sakit,
                'izin' => $izin,
                'alfa' => $alfa,
                'persentase' => $totalAbsensi > 0 ? round(($hadir / $totalAbsensi) * 100, 1) : 0,
                'rata_rata_nilai' => $peserta->rata_rata_nilai,
            ];
        }

        return view('pembimbing.rekap.index', compact('rekapData'));
    }
}
