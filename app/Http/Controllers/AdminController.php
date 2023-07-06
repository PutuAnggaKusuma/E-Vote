<?php

namespace App\Http\Controllers;

use App\Models\Banjar;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{    
    public function index()
    {
        $admins = User::where('status', 2)->get();
        $banjars = Banjar::all();

        return view('admin.index', compact('admins', 'banjars'));
    }

    public function login() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $banjars = Banjar::all();
        $jumlahPendudukPerBanjar = Penduduk::select('id_banjars', \DB::raw('count(*) as total'))
            ->groupBy('id_banjars')
            ->orderBy('id_banjars')
            ->get()
            ->pluck('total', 'id_banjars')
            ->toArray();

        $jumlahPemilihPerBanjar = Penduduk::whereRaw('YEAR(CURRENT_DATE) - YEAR(tanggal_lahir) >= 17')
            ->select('id_banjars', \DB::raw('COUNT(*) as total'))
            ->groupBy('id_banjars')
            ->orderBy('id_banjars')
            ->get()
            ->pluck('total', 'id_banjars')
            ->toArray();

        return view('admin.dashboard', compact('banjars', 'jumlahPendudukPerBanjar', 'jumlahPemilihPerBanjar'));
    }

    public function store(Request $request) 
    {
        $newAdmin = $request->validate([
            'nama'  => 'required|max:60',
            'email' => 'required|max:60',
        ]);
        $newAdmin['password'] = Hash::make($request->password);
        $newAdmin['status'] = 2;
        $newAdmin['id_banjars'] = $request->banjar_id;

        $admin = User::create($newAdmin);

        return redirect()->route('admin.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:60',
        ]);
        
        $admin = User::find($id);
        $admin->nama = $request->nama;
        $admin->id_banjars = $request->banjar_id;
        $success = $admin->save();

        if ($success) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.index');
    }

    public function destroy(Request $request, $id)
    {
        $admin = User::find($id);
        $success = $admin->delete();

        if ($success) {
            return redirect()->route('admin.index');
        }
        return redirect()->route('admin.index');
    }
}