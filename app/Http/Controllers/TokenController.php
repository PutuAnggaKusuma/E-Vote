<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = Token::whereHas('penduduk', function ($query) {
            $query->where('id_banjars', auth()->user()->id_banjars);
        })->get();

        $tahunPemilihan = Carbon::now()->year;

        $penduduks = DB::table('penduduks')
            ->select('penduduks.*')
            ->leftJoin('tokens', function ($join) use ($tahunPemilihan) {
                $join->on('penduduks.id', '=', 'tokens.id_penduduks')
                    ->whereRaw('YEAR(tokens.use_date) = ?', [$tahunPemilihan]);
            })
            ->whereRaw('YEAR(?) - YEAR(penduduks.tanggal_lahir) >= 17', [Carbon::now()])
            ->whereNull('tokens.token')
            ->where('id_banjars', auth()->user()->id_banjars)
            ->get();

        return view('admin.token', compact('tokens', 'penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penduduks' => 'required|max:60',
            'use_date'     => 'required',
        ]);
        
        $curDate = Carbon::now()->format('Y-m-d H:i:s');
        $hashedValue = Hash::make($curDate);
        $userToken = preg_replace('/[^a-zA-Z0-9]/', '', $hashedValue);
        $userToken = substr($userToken, 7, 8);

        $token = new Token();
        $token->token = $userToken;
        $token->id_penduduks = $request->id_penduduks;
        $token->use_date = $request->use_date;
        $success = $token->save();

        if ($success) {
            return redirect()->route('token.index');
        }

        return redirect()->route('token.index');
    }

    public function destroy(Request $request, $id)
    {
        $token = Token::find($id);
        $success = $token->delete();

        if ($success) {
            return redirect()->route('token.index');
        }
        return redirect()->route('token.index');
    }
}