@extends('admin.layout')

@section('title')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div style="position: fixed; bottom: 1em; right: 1em;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Welcome</span> {{auth()->user()->nama}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div style="padding: 0 1em; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1em;">
        @php
            $colors = ['#3AA6B9', '#FF9EAA', '#A0C49D', '#F24C3D', '#FFE569', '#ECCDB4'];
        @endphp

        @foreach ($banjars as $banjar)
            @php
                $randomColor = $colors[($loop->index)];
            @endphp

            <div style="background-color: {{ $randomColor }}; padding: 1em; color: white;">
                <span style="font-size: 1.2em">Banjar : {{$banjar->nama}}</span>
                <div style="width: 100%;">
                    <div style="width:100%; font-size: 3em; text-align:end;">
                        {{ $jumlahPemilihPerBanjar[$banjar->id] ?? 0}}/{{ $jumlahPendudukPerBanjar[$banjar->id] ?? 0 }}
                    </div>
                    <div style="font-size: 1em; margin-top: 1em;">
                        {{ $jumlahPemilihPerBanjar[$banjar->id] ?? 0}} pemilih dari {{ $jumlahPendudukPerBanjar[$banjar->id] ?? 0 }} penduduk
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection