<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Submission;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tugasList = Tugas::where('assigned_to', $user->id)
            ->with(['submission' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }])
            ->latest()
            ->get();

        return view('peserta.tugas.index', compact('tugasList'));
    }

    public function show(Tugas $tuga)
    {
        if ($tuga->assigned_to !== auth()->id()) {
            abort(403);
        }

        $submission = Submission::where('tugas_id', $tuga->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('peserta.tugas.show', compact('tuga', 'submission'));
    }

    public function submit(Request $request, Tugas $tuga)
    {
        if ($tuga->assigned_to !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240',
        ], [
            'file.required' => 'File wajib diupload.',
            'file.mimes' => 'Format file harus JPG, PNG, PDF, DOC, DOCX, XLS, atau XLSX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ]);

        // Check if already submitted
        $existing = Submission::where('tugas_id', $tuga->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            // Delete old file
            if (\Storage::disk('public')->exists($existing->file_path)) {
                \Storage::disk('public')->delete($existing->file_path);
            }
            $existing->delete();
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('submissions', $fileName, 'public');

        Submission::create([
            'tugas_id' => $tuga->id,
            'user_id' => auth()->id(),
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
