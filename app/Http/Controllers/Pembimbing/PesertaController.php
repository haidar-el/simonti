<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertaList = User::where('pembimbing_id', auth()->id())
            ->where('role', 'peserta')
            ->latest()
            ->get();

        return view('pembimbing.peserta.index', compact('pesertaList'));
    }

    public function create()
    {
        return view('pembimbing.peserta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nim' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tingkat_pendidikan' => 'required|in:D3,D4,S1',
            'durasi_pkl' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after:tanggal_masuk',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'peserta',
            'pembimbing_id' => auth()->id(),
            'nim' => $request->nim,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'institusi' => $request->institusi,
            'jurusan' => $request->jurusan,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'durasi_pkl' => $request->durasi_pkl,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        return redirect()->route('pembimbing.peserta.index')
            ->with('success', 'Peserta magang berhasil ditambahkan.');
    }

    public function edit(User $pesertum)
    {
        if ($pesertum->pembimbing_id !== auth()->id()) {
            abort(403);
        }
        return view('pembimbing.peserta.edit', compact('pesertum'));
    }

    public function update(Request $request, User $pesertum)
    {
        if ($pesertum->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pesertum->id,
            'nim' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tingkat_pendidikan' => 'required|in:D3,D4,S1',
            'durasi_pkl' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after:tanggal_masuk',
        ]);

        $data = $request->only([
            'nama', 'email', 'nim', 'jenis_kelamin', 'no_hp',
            'institusi', 'jurusan', 'tingkat_pendidikan',
            'durasi_pkl', 'tanggal_masuk', 'tanggal_keluar',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $pesertum->update($data);

        return redirect()->route('pembimbing.peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(User $pesertum)
    {
        if ($pesertum->pembimbing_id !== auth()->id()) {
            abort(403);
        }

        $pesertum->delete();

        return redirect()->route('pembimbing.peserta.index')
            ->with('success', 'Peserta berhasil dihapus.');
    }
}
