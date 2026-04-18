<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::where('pembimbing_id', auth()->id())
            ->with(['assignedTo', 'submission'])
            ->latest()
            ->get();

        return view('pembimbing.tugas.index', compact('tugas'));
    }

    public function create()
    {
        $pesertaList = User::where('pembimbing_id', auth()->id())
            ->where('role', 'peserta')
            ->get();

        return view('pembimbing.tugas.create', compact('pesertaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'assigned_to' => 'required|exists:users,id',
        ]);

        // Verify assigned_to is a peserta under this pembimbing
        $peserta = User::findOrFail($request->assigned_to);
        if ($peserta->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        Tugas::create([
            'pembimbing_id' => auth()->id(),
            'assigned_to' => $request->assigned_to,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('pembimbing.tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Tugas $tuga)
    {
        if ($tuga->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $tuga->load(['assignedTo', 'submission']);
        return view('pembimbing.tugas.show', compact('tuga'));
    }

    public function edit(Tugas $tuga)
    {
        if ($tuga->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $pesertaList = User::where('pembimbing_id', auth()->id())
            ->where('role', 'peserta')
            ->get();

        return view('pembimbing.tugas.edit', compact('tuga', 'pesertaList'));
    }

    public function update(Request $request, Tugas $tuga)
    {
        if ($tuga->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $tuga->update($request->only(['judul', 'deskripsi', 'deadline', 'assigned_to']));

        return redirect()->route('pembimbing.tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tuga)
    {
        if ($tuga->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $tuga->delete();

        return redirect()->route('pembimbing.tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

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
