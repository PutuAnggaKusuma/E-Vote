<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    public function index()
    {
        $kandidats = Kandidat::all();

        return view('admin.kandidat', compact('kandidats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_pasangan' => 'required',
            'nama_kepala' => 'required|max:60',
            'nama_wakil_kepala' => 'required|max:60',
            'foto' => 'image',
            'visi' => 'required',
            'misi' => 'required',
        ]);
        
        $kandidat = new Kandidat();
        $kandidat->nomor_pasangan = $request->nomor_pasangan;
        $kandidat->nama_kepala = $request->nama_kepala;
        $kandidat->nama_wakil_kepala = $request->nama_wakil_kepala;
        $kandidat->foto = $request->file('foto')->store('foto-kandidat');
        $kandidat->visi = $request->visi;
        $kandidat->misi = $request->misi;
        $success = $kandidat->save();

        if ($success) {
            return redirect()->route('kandidat.index');
        }

        return redirect()->route('kandidat.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_pasangan' => 'required',
            'nama_kepala' => 'required|max:60',
            'nama_wakil_kepala' => 'required|max:60',
            'foto' => 'image',
            'visi' => 'required',
            'misi' => 'required',
        ]);
        
        $kandidat = Kandidat::find($id);
        $kandidat->nomor_pasangan = $request->nomor_pasangan;
        $kandidat->nama_kepala = $request->nama_kepala;
        $kandidat->nama_wakil_kepala = $request->nama_wakil_kepala;
        if ($request->foto) {
            Storage::delete($kandidat->foto);
            $kandidat->foto = $request->file('foto')->store('foto-kandidat');
        }
        $kandidat->visi = $request->visi;
        $kandidat->misi = $request->misi;
        $success = $kandidat->save();

        if ($success) {
            return redirect()->route('kandidat.index');
        }

        return redirect()->route('kandidat.index');
    }

    public function destroy(Request $request, $id)
    {
        $kandidat = Kandidat::find($id);
        Storage::delete($kandidat->foto);
        $success = $kandidat->delete();

        if ($success) {
            return redirect()->route('kandidat.index');
        }
        return redirect()->route('kandidat.index');
    }
}