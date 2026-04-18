<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    public function index()
    {
        $pembimbings = User::where('role', 'pembimbing')
            ->withCount('pesertaMagangs')
            ->latest()
            ->get();

        return view('admin.pembimbing.index', compact('pembimbings'));
    }

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:20',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembimbing',
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.pembimbing.index')
            ->with('success', 'Pembimbing berhasil ditambahkan.');
    }

    public function edit(User $pembimbing)
    {
        return view('admin.pembimbing.edit', compact('pembimbing'));
    }

    public function update(Request $request, User $pembimbing)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pembimbing->id,
            'no_hp' => 'nullable|string|max:20',
        ]);

        $data = $request->only(['nama', 'email', 'no_hp']);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $pembimbing->update($data);

        return redirect()->route('admin.pembimbing.index')
            ->with('success', 'Pembimbing berhasil diperbarui.');
    }

    public function destroy(User $pembimbing)
    {
        $pembimbing->delete();

        return redirect()->route('admin.pembimbing.index')
            ->with('success', 'Pembimbing berhasil dihapus.');
    }
}
