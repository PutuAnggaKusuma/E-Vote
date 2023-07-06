<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Token;
use App\Models\Voting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class VotingController extends Controller
{
    public function index() {
        return view('users.landing');
    }

    public function check_code(Request $request) {
        $code = $request->code;
        $token = Token::where('token', $code)->first();

        if ($token) {
            if ($token->penggunaan === 0) {
                $curDate = Carbon::now()->format('Y-m-d');
                $tokenUseDate = Carbon::parse($token->use_date)->format('Y-m-d');
                if ($curDate === $tokenUseDate) {
                    return redirect()->route('user.voting', $code);
                } elseif ($curDate < $tokenUseDate) {
                    return redirect()->route('user.index')->with('Error', 'Kode pemilihan belum berlaku');
                }

                return redirect()->route('user.index')->with('Error', 'Masa berlaku kode pemilihan sudah lewat');
            }

            return redirect()->route('user.index')->with('Error', 'Anda sudah melakukan pemilihan');
        }

        return redirect()->route('user.index')->with('Error', 'Kode Anda tidak valid');
    }

    public function voting($code) {
        $user = Token::where('token', $code)->first();
        $kandidats = Kandidat::all();

        if ($user) {
            return view('users.voting', compact('user', 'kandidats'));
        }

        return redirect()->route('user.index')->with('Error', 'Kode Anda tidak valid');
    }

    public function vote(Request $request, $id) {
        $newVote = $request->validate([
            'id_penduduks' => 'required',
            'id_kandidats' => 'required',
        ]);

        $success = Voting::create($newVote);

        if ($success) {
            $token = Token::find($id);
            $token->penggunaan = 1;
            $success = $token->save();

            if ($success) {
                return redirect()->route('user.index')->with('Success', 'Berhasil melakukan voting!');
            }
        }

        return redirect()->route('user.index')->with('Error', 'Maaf, terjadi kesalahan');
    }

    public function hasil_voting(Request $request) {
        $curYear = 0;
        if ($request->year) {
            $curYear = $request->year;
        } else {
            $curYear = now()->year;
        }

        $results = Voting::select('id_kandidats', DB::raw('COUNT(*) as total'))
                ->whereYear('created_at', $curYear)
                ->groupBy('id_kandidats')
                ->orderBy('id_kandidats', 'asc')
                ->get();

        $resultArray = [];

        foreach ($results as $result) {
            $totalVote = $result->total;
            $percentage = number_format(($result->total / count($results)) * 100, 2);

            $kandidat = Kandidat::find($result->id_kandidats);
            $paslon = $kandidat->nama_kepala . ' dan ' . $kandidat->nama_wakil_kepala;

            $resultObject = new stdClass();
            $resultObject->noPaslon = $kandidat->nomor_pasangan;
            $resultObject->label = $paslon;
            $resultObject->totalVote = $totalVote;
            $resultObject->percentage = $percentage;

            $resultArray[] = $resultObject;
        }

        return view('admin.hasilvoting', compact('resultArray', 'curYear'));
    }
}