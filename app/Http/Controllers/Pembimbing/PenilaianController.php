<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Rekap nilai & absensi seluruh peserta bimbingan.
     */
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

    /**
     * Beri nilai pada submission peserta.
     */
    public function nilaiSubmission(Request $request, Submission $submission)
    {
        // Verify this submission belongs to a task owned by this pembimbing
        if ($submission->tugas->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $submission->update([
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Nilai berhasil diberikan.');
    }
}
