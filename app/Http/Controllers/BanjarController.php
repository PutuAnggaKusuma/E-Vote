<?php

namespace App\Http\Controllers;

use App\Models\Banjar;
use Illuminate\Http\Request;

class BanjarController extends Controller
{

    public function index()
    {
        $banjars = Banjar::all();

        return view('admin.banjar', compact('banjars'));
    }

    public function store(Request $request)
    {
        $enwBanjar = $request->validate([
            'nama' => 'required|max:60',
        ]);

        $banjar = Banjar::create($enwBanjar);

        return redirect()->route('banjar.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:60',
        ]);
        
        $banjar = Banjar::find($id);
        $banjar->nama = $request->nama;
        $success = $banjar->save();

        if ($success) {
            return redirect()->route('banjar.index');
        }

        return redirect()->route('banjar.index');
    }

    public function destroy(Request $request, $id)
    {
        $banjar = Banjar::find($id);
        $success = $banjar->delete();

        if ($success) {
            return redirect()->route('banjar.index');
        }
        return redirect()->route('banjar.index');
    }
}