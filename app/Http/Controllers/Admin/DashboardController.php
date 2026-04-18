<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPembimbing = User::where('role', 'pembimbing')->count();
        $totalPeserta = User::where('role', 'peserta')->count();

        return view('admin.dashboard', compact('totalPembimbing', 'totalPeserta'));
    }
}
