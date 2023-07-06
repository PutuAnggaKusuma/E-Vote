<?php

namespace App\Http\Controllers;

use App\Models\Banjar;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = Penduduk::where('id_banjars', auth()->user()->id_banjars)->get();
        $banjar = Banjar::where('id', auth()->user()->id_banjars)->first();

        return view('admin.penduduk', compact('penduduks', 'banjar'));
    }

    public function pemilih()
    {
        $penduduks = Penduduk::whereRaw('YEAR(CURRENT_DATE) - YEAR(tanggal_lahir) >= 17')->where('id_banjars', auth()->user()->id_banjars)->get();

        return view('admin.pemilih', compact('penduduks'));
    }

    public function store(Request $request) 
    {
        $newPenduduk = $request->validate([
            'nama'  => 'required|max:60',
            'tanggal_lahir' => 'required',
            'KTP' => 'max:17',
            'KK' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_telp' => 'required|max:13',
        ]);
        $newPenduduk['id_banjars'] = auth()->user()->id_banjars;

        $penduduk = Penduduk::create($newPenduduk);

        return redirect()->route('penduduk.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|max:60',
            'tanggal_lahir' => 'required',
            'KTP' => 'max:17',
            'KK' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_telp' => 'required|max:13',
        ]);
        
        $penduduk = Penduduk::find($id);
        $penduduk->nama = $request->nama;
        $penduduk->tanggal_lahir = $request->tanggal_lahir;
        $penduduk->KTP = $request->KTP;
        $penduduk->KK = $request->KK;
        $penduduk->jenis_kelamin = $request->jenis_kelamin;
        $penduduk->agama = $request->agama;
        $penduduk->no_telp = $request->no_telp;
        $success = $penduduk->save();

        if ($success) {
            return redirect()->route('penduduk.index');
        }

        return redirect()->route('penduduk.index');
    }

    public function destroy(Request $request, $id)
    {
        $penduduk = Penduduk::find($id);
        $success = $penduduk->delete();

        if ($success) {
            return redirect()->route('penduduk.index');
        }
        return redirect()->route('penduduk.index');
    }
}
